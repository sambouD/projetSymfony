<?php 
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Classe de pagination qui extrait toute notion de calcul et de récupération de données de nos controllers
 * 
 * Elle nécessite après instanciation qu'on lui passe l'entité sur laquelle on souhaite travailler
 */
class Pagination{

    /**
     * Le nom de l'entité sur laquelle on veut effectuer une pagination 
     *
     * @var string
     */
    private $entityClass; 
    /**
     * Le nombre d'enregistrement à récupérer
     *
     * @var integer
     */
    private $limit = 10;
    /**
     * La page sur laquelle on se trouve actuellement 
     *
     * @var integer
     */
    private $currentPage = 1;
    /**
     * Le manager de Doctrine qui nous permet notamment de trouver le repository dont on a besoin
     *
     * @var EntityManagerInterface
     */
    private $manager;
   
/**
 * Constructeur du service de pagination qui sera appelé par Symfony
 * 
 * 
 *
 * @param EntityManagerInterface $manager
 */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        
    }


/**
 * Perme de récupérer le nombre de pages qui existent sur une entité particulière
 * 
 * Elle se sert de Doctrine pour récupérer le repository qui correspond à l'entité que l'on souhaite
 * paginer (voir la propriété $entityClass) puis elle trouve le nombre total d'enregistrement grâce
 * à la fonction finAll() du repository
 *
 * @return Exception si la propriété $entityClass n'est pas configurée
 * 
 * @return  int
 */
    public function getPages(){
        if (empty($this->entityClass)) {
            // Si il n'y a pas d'entité configurée, on ne peut pas charger le repository, la fonction 
            // ne peut donc pas continuer !
            throw new \Exception("Vous n'avez pas spécifié l'entité sur laquelle nous devons paginer ! 
            Utilisez la méthode setEntityClass() de votre objet PaginationService !");
        }
            // 1) Connaitre le total des enregistrements de la table
            $repo = $this->manager->getRepository($this->entityClass);
            $total = count($repo->findAll());

            // 2) Faire la division, l'arrondi et le renvoyer
            $pages = ceil($total / $this->limit);
        return $pages;
    }

/**
 * Permet de récupérer les données paginées pour une entité spécifique
 * 
 * Elle se sert de Doctrine pour récupérer le repository qui correspond à l'entité que l'on souhaite
 * puis grâce au repository et à sa fonction findBy() on récupère les données dans une certaine limite et en partant d'un 
 * offset
 *
 * @return Exception si la propriété $entityClass n'est pas configurée
 */
    public function getData(){
        if (empty($this->entityClass)) {
            throw new \Exception("Vous n'avez pas spécifié l'entité sur laquelle nous devons paginer ! 
            Utilisez la méthode setEntityClass() de votre objet PaginationService !");
        }
        // 1) Calculer l'offset
        $offset = $this->currentPage * $this->limit - $this->limit;

        // 2) Demander au repository de trouver les éléments

        $repo = $this->manager->getRepository($this->entityClass);
        $data = $repo->findBy([], [], $this->limit, $offset);


        // 3) Renvoyer les éléments en question

        return $data;
    }

    /**
     * Set de Current Page
     *
     * @param [type] $page
     * @return void
     */
    public function setPage($page){
        $this->currentPage = $page;

        return $this;
    }

    /**
     * Get de Current Page
     *
     * @return void
     */
    public function getPage(){
        return $this->currentPage;
    }


    public function setLimit($limit){
        $this->limit = $limit;
        
        return $this;
    }

    /**
     * get de limit 
     *
     * @return void
     */
    public function getLimit(){
        return $this->limit;
    }


    public function setEntityClass($entityClass) {
        $this->entityClass = $entityClass;

        return $this;
    }

    /**
     * get de entityClass
     *
     * @return void
     */
    public function getEntityClass() {
        return $this->entityClass;
    }
}