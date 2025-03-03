<?php


namespace Musielak\Back\Router;

//  ;

class Route
{




    public function __construct(
        private string $path, // chemin genre /login
        private mixed $call,  //appel du controller
        public array $matches = [], // les param genre id et tout /login/id{1}
        public array $params = [] // les paramètres du chemin apres le ?
    ) {
        $this->path = trim($path, '/');
    }


    public function match(string $url)
    {
        $url = trim($url, '/');

        // Remplacez les paramètres dans le chemin
        $path = preg_replace_callback(
            '#:([\w]+)#', // Motif pour trouver les paramètres
            [$this, 'paramMatch'], // Utilisez la méthode paramMatch
            $this->path // Le chemin à modifier
        );

        $regex = "#^$path$#i";
        if (!preg_match($regex, $url, $matches)) {
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    private function paramMatch($match)
    {
        if (isset($this->params[$match[1]])) {
            return '(' . $this->params[$match[1]] . ')';
        }
        return '([^/]+)'; // Valeur par défaut si le paramètre n'est pas défini
    }

    public function call()
    {
        return call_user_func_array($this->call, $this->matches);
    }

    public function whith($param, $regex)
    {
        $this->params[$param]  = str_replace('(', '(?:', $regex);
        return $this;
    }
}
