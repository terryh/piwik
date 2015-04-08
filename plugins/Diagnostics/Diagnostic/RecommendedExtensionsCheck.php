<?php

namespace Piwik\Plugins\Diagnostics\Diagnostic;

use Piwik\Translation\Translator;

/**
 * Check the PHP extensions that are not required but recommended.
 */
class RecommendedExtensionsCheck implements Diagnostic
{
    /**
     * @var Translator
     */
    private $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function execute()
    {
        $label = $this->translator->translate('Installation_SystemCheckOtherExtensions');

        $result = new DiagnosticResult($label);

        foreach ($this->getRecommendedExtensions() as $extension) {
            if (! in_array($extension, $this->getPhpExtensionsLoaded())) {
                $status = DiagnosticResult::STATUS_WARNING;
                $comment = $extension . '<br/>' . $this->getHelpMessage($extension);
            } else {
                $status = DiagnosticResult::STATUS_OK;
                $comment = $extension;
            }

            $result->addItem(new DiagnosticResultItem($status, $comment));
        }

        return array($result);
    }

    /**
     * @return string[]
     */
    private function getRecommendedExtensions()
    {
        return array(
            'json',
            'libxml',
            'dom',
            'SimpleXML',
        );
    }

    private function getHelpMessage($missingExtension)
    {
        $messages = array(
            'json'      => 'Installation_SystemCheckWarnJsonHelp',
            'libxml'    => 'Installation_SystemCheckWarnLibXmlHelp',
            'dom'       => 'Installation_SystemCheckWarnDomHelp',
            'SimpleXML' => 'Installation_SystemCheckWarnSimpleXMLHelp',
        );

        return $this->translator->translate($messages[$missingExtension]);
    }

    private function getPhpExtensionsLoaded()
    {
        return @get_loaded_extensions();
    }
}
