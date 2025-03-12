<?php

namespace Stoneage\Back\HTTP;

class HttpRequest {
    private array $get;
    private array $post;
    private ?array $json;
    private string $method;

    public function __construct() {
        $this->get = $_GET ?? [];
        $this->post = $_POST ?? [];
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->json = $this->getJsonData();
    }

    /**
     * Récupère les données JSON de la requête
     */
    private function getJsonData(): ?array {
        $input = file_get_contents('php://input');
        if (!empty($input)) {
            $data = json_decode($input, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $data;
            }
        }
        return null;
    }

    /**
     * Récupère un paramètre GET
     */
    public function getParam(string $key, $default = null) {
        return $this->get[$key] ?? $default;
    }

    /**
     * Récupère un paramètre POST
     */
    public function getPostParam(string $key, $default = null) {
        return $this->post[$key] ?? $default;
    }

    /**
     * Récupère une donnée JSON
     */
    public function getJsonParam(?string $key = null, $default = null) {
        if ($key === null) {
            return $this->json;
        }
        return $this->json[$key] ?? $default;
    }

    /**
     * Vérifie la méthode HTTP
     */
    public function isMethod(string $method): bool {
        return strtoupper($this->method) === strtoupper($method);
    }

    /**
     * Récupère la méthode HTTP
     */
    public function getMethod(): string {
        return $this->method;
    }

    public function getPath():string {
        return $this->$_SERVER["REQUEST_URI"];
    }
    
}
