<?php
declare(strict_types=1);

namespace ObsidianPages\Routing {

    final class RouteData
    {
        public string $uri;
        private bool $error;

        public function __construct($serverData)
        {
            $this->error = false;
            if (strlen($serverData['DOCUMENT_URI']) < strlen(BASE_URL)) {
                $this->error = true;
            }

            $this->uri = '/'. substr($serverData['DOCUMENT_URI'], strlen(BASE_URL));
        }

        public function checkError(): bool {
            return $this->error;
        }
    }
}