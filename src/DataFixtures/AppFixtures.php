<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\Table;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }


    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        $faker->addProvider(new \FakerRestaurant\Provider\fr_FR\Restaurant($faker));
        // Création d'un user "normal"
        $user = new User();
        $user->setEmail("user@illico-presto.com");
        $user->setLastName('pierre');
        $user->setFirstName('laurent');
        $user->setPhoneNumber('0123456789');
        $user->setRoles(["ROLE_SERVEUR"]);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "password"));
        $manager->persist($user);$manager->flush();


        // Création d'un user admin
        $userAdmin = new User();
        $userAdmin->setEmail("admin@illico-presto.com");
        $userAdmin->setLastName('pierrot');
        $userAdmin->setFirstName('lolo');
        $userAdmin->setPhoneNumber('0123486789');
        $userAdmin->setRoles(["ROLE_ADMIN"]);
        $userAdmin->setPassword($this->userPasswordHasher->hashPassword($userAdmin, "password"));
        $manager->persist($userAdmin);$manager->flush();


        //fake categories


        $entrees = new Category();
        $entrees->setCategoryName('Entrées');
        $manager->persist($entrees);
        $manager->flush();

        $plats = new Category();
        $plats->setCategoryName('Plats');
        $manager->persist($plats);
        $manager->flush();

        $desserts = new Category();
        $desserts->setCategoryName('Desserts');
        $manager->persist($desserts);
        $manager->flush();
        //fake products

                $product1 = new Product();
                $product1->setProductName('salade')
                        ->setProductDescription($faker->text(16))
                        ->setCategory($entrees)->
                        setPrice($faker->numberBetween(5,30)
                        );
                $manager->persist($product1);
                $manager->flush();


                $product2 = new Product();
                $product2->setProductName('tarte aux fraises')
                        ->setProductDescription($faker->text(16))
                        ->setCategory($desserts)
                        ->setPrice($faker->numberBetween(5,30)
                        );
                $manager->persist($product2);
                $manager->flush();
                $product3 = new Product();
                $product3->setProductName('quiche lorraine')
                        ->setProductDescription($faker->text(16))
                        ->setCategory($plats)->
                        setPrice($faker->numberBetween(5,30)
                        );
                $manager->persist($product3);
                $manager->flush();

        //fake tables

        $tables = [];

        for ($i=1; $i<=12; $i++){
            $table = new Table();
            $table->setTableNumber($i);
            $tables[$i]=$table;
            $manager->persist($table);
            $manager->flush();
        }

        //fake orders
        $order1= new Order();
        $order2= new Order();
        $order1->setOrderTable($tables[1])->setOrderTime($faker->dateTime)->setServiceTime($faker->dateTime)->setIsServed(false);
        $manager->persist($order1);
        $manager->flush();
        $order2->setOrderTable($tables[8])->setOrderTime($faker->dateTime)->setServiceTime($faker->dateTime)->setIsServed(false);

        $manager->persist($order2);
        $manager->flush();




    }
}
