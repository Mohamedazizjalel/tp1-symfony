namespace App\Controller;

use App\Entity\Tache;
use App\Repository\TacheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TacheController extends AbstractController
{
    #[Route('/taches', name: 'tache_liste')]
    public function index(TacheRepository $repo): Response
    {
        $taches = $repo->findBy([], ['terminee' => 'ASC', 'dateCreation' => 'DESC']);

        return $this->render('tache/index.html.twig', [
            'taches' => $taches,
        ]);
    }

    #[Route('/taches/ajouter', name: 'tache_ajouter')]
    public function ajouter(EntityManagerInterface $em): Response
    {
        $tache = new Tache();
        $tache->setTitre('Nouvelle tâche ' . rand(1, 100));
        $tache->setDescription('Description générée automatiquement');
        $tache->setTerminee(false);
        $tache->setDateCreation(new \DateTime());

        $em->persist($tache);
        $em->flush();

        return $this->redirectToRoute('tache_liste');
    }

    #[Route('/taches/{id}', name: 'tache_detail')]
    public function detail(Tache $tache): Response
    {
        return $this->render('tache/detail.html.twig', [
            'tache' => $tache,
        ]);
    }

    #[Route('/taches/{id}/terminer', name: 'tache_terminer')]
    public function terminer(Tache $tache, EntityManagerInterface $em): Response
    {
        $tache->setTerminee(true);
        $em->flush();

        return $this->redirectToRoute('tache_liste');
    }
}
