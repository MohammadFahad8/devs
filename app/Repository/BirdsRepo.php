<?php
namespace App\Repository;

use App\Models\Birds;
use Doctrine\ORM\EntityManager;

class BirdsRepo
{
    private $class = 'App\Entity\Bird';
    private $em;
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function create(Birds $post)
    {
        $this->em->persist($post);
        $this->em->flush();
    }

    public function update(Birds $post, $data)
    {
        $post->setTitle($data['title']);
        $post->setBody($data['body']);
        $this->em->persist($post);
        $this->em->flush();
    }

    public function PostOfId($id)
    {
        return $this->em->getRepository($this->class)->findOneBy([
            'id' => $id,
        ]);
    }

    public function delete(Birds $post)
    {
        $this->em->remove($post);
        $this->em->flush();
    }

    /**
     * create Post
     * @return Post
     */
    private function prepareData($data)
    {
        return new Birds($data);
    }
}
