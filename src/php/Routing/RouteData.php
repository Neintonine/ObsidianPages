<?php
declare(strict_types=1);

namespace ObsidianPages\Routing {

    use ObsidianPages\Configuration\Configuration;
    use ObsidianPages\Configuration\ConfigurationHandler;
    use ObsidianPages\Configuration\Configurations\BasicConfiguration;

    final class RouteData
    {
        public string $uri;
        private bool $error;

        public function __construct($serverData)
        {
            $baseURL = ConfigurationHandler::Instance()->Get(BasicConfiguration::class)->getBaseURL();

            $this->error = false;
            if (strlen($serverData['DOCUMENT_URI']) < strlen($baseURL)) {
                $this->error = true;
            }
            $this->uri = '/'. substr($serverData['DOCUMENT_URI'], strlen($baseURL));
        }

        public function checkError(): bool {
            return $this->error;
        }
    }
}