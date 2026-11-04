<?php

namespace App\DataFixtures;

use App\Entity\DarkPattern;
use App\Entity\DarkPatternCategory;
use App\Entity\DarkPatternCharacteristic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 1. CATEGORIE DEI DARK PATTERNS

        $categories = [
            [
                'name' => 'Sneaking',
                'description' => 'Tecniche che introducono informazioni, costi o elementi indesiderati senza renderli sufficientemente evidenti.'
            ],
            [
                'name' => 'Urgency',
                'description' => 'Tecniche che creano un senso di urgenza per spingere l’utente a prendere decisioni rapidamente.'
            ],
            [
                'name' => 'Misdirection',
                'description' => 'Tecniche che influenzano l’attenzione dell’utente o lo indirizzano verso una scelta specifica.'
            ],
            [
                'name' => 'Social Proof',
                'description' => 'Tecniche che utilizzano il comportamento o le opinioni di altre persone per influenzare le decisioni.'
            ],
            [
                'name' => 'Scarcity',
                'description' => 'Tecniche che comunicano una disponibilità limitata di prodotti o servizi.'
            ],
            [
                'name' => 'Obstruction',
                'description' => 'Tecniche che rendono più difficile completare determinate azioni, come cancellare un servizio.'
            ],
            [
                'name' => 'Forced Action',
                'description' => 'Tecniche che obbligano l’utente a compiere un’azione per poter proseguire.'
            ],
        ];

        $categoryRepository = $manager->getRepository(DarkPatternCategory::class);

        foreach ($categories as $data) {

            $existingCategory = $categoryRepository->findOneBy([
                'name' => $data['name']
            ]);

            if ($existingCategory) {
                continue;
            }

            $category = new DarkPatternCategory();
            $category->setName($data['name']);
            $category->setDescription($data['description']);

            $manager->persist($category);
        }

        $manager->flush();


        // 2. CARATTERISTICHE DEI DARK PATTERNS

        $characteristics = [
            [
                'name' => 'Asymmetric',
                'description' => 'L’interfaccia attribuisce pesi o difficoltà differenti alle opzioni disponibili, favorendo una scelta rispetto a un’altra.'
            ],
            [
                'name' => 'Covert',
                'description' => 'L’effetto della progettazione dell’interfaccia rimane nascosto all’utente.'
            ],
            [
                'name' => 'Deceptive',
                'description' => 'L’interfaccia induce l’utente a sviluppare convinzioni false attraverso informazioni ingannevoli, dichiarazioni fuorvianti o omissioni.'
            ],
            [
                'name' => 'Hides Information',
                'description' => 'L’interfaccia nasconde o rende difficili da individuare informazioni importanti per l’utente.'
            ],
            [
                'name' => 'Restrictive',
                'description' => 'L’interfaccia limita le possibilità di scelta o le azioni disponibili per l’utente.'
            ],
        ];

        $characteristicRepository = $manager->getRepository(
            DarkPatternCharacteristic::class
        );

        foreach ($characteristics as $data) {

            $existingCharacteristic = $characteristicRepository->findOneBy([
                'name' => $data['name']
            ]);

            if ($existingCharacteristic) {
                continue;
            }

            $characteristic = new DarkPatternCharacteristic();
            $characteristic->setName($data['name']);
            $characteristic->setDescription($data['description']);

            $manager->persist($characteristic);
        }

        $manager->flush();


        // 3. DARK PATTERNS

        $patterns = [
            // Sneaking
            [
                'name' => 'Sneak into Basket',
                'category' => 'Sneaking',
                'description' => 'Aggiunta di prodotti al carrello senza una scelta esplicita dell’utente.'
            ],
            [
                'name' => 'Hidden Costs',
                'category' => 'Sneaking',
                'description' => 'Costi aggiuntivi mostrati soltanto nelle fasi finali del processo di acquisto.'
            ],
            [
                'name' => 'Hidden Subscription',
                'category' => 'Sneaking',
                'description' => 'Attivazione o presenza di un abbonamento nascosto o poco evidente.'
            ],

            // Urgency
            [
                'name' => 'Countdown Timer',
                'category' => 'Urgency',
                'description' => 'Timer che comunica una scadenza imminente per spingere l’utente ad agire.'
            ],
            [
                'name' => 'Limited-time Message',
                'category' => 'Urgency',
                'description' => 'Messaggi che presentano un’offerta come disponibile solo per un periodo limitato.'
            ],

            // Misdirection
            [
                'name' => 'Confirmshaming',
                'category' => 'Misdirection',
                'description' => 'Messaggi che colpevolizzano o mettono a disagio l’utente per condizionare una scelta.'
            ],
            [
                'name' => 'Visual Interference',
                'category' => 'Misdirection',
                'description' => 'Uso di elementi visivi per rendere alcune opzioni meno evidenti o accessibili.'
            ],
            [
                'name' => 'Trick Questions',
                'category' => 'Misdirection',
                'description' => 'Domande formulate in modo ambiguo per indurre l’utente a una scelta non intenzionale.'
            ],
            [
                'name' => 'Pressured Selling',
                'category' => 'Misdirection',
                'description' => 'Tecniche che spingono l’utente ad acquistare attraverso pressioni durante il processo.'
            ],

            // Social Proof
            [
                'name' => 'Activity Message',
                'category' => 'Social Proof',
                'description' => 'Messaggi che mostrano presunte attività o acquisti di altri utenti.'
            ],
            [
                'name' => 'Testimonials',
                'category' => 'Social Proof',
                'description' => 'Testimonianze utilizzate per influenzare la fiducia e le decisioni dell’utente.'
            ],

            // Scarcity
            [
                'name' => 'Low-stock Message',
                'category' => 'Scarcity',
                'description' => 'Messaggi che comunicano una disponibilità limitata di prodotti.'
            ],
            [
                'name' => 'High-demand Message',
                'category' => 'Scarcity',
                'description' => 'Messaggi che comunicano una domanda elevata per aumentare la pressione all’acquisto.'
            ],

            // Obstruction
            [
                'name' => 'Hard to Cancel',
                'category' => 'Obstruction',
                'description' => 'Ostacoli che rendono difficile cancellare un servizio o un abbonamento.'
            ],

            // Forced Action
            [
                'name' => 'Forced Enrollment',
                'category' => 'Forced Action',
                'description' => 'Obbligo di registrazione o creazione di un account per poter completare un’azione.'
            ],
        ];

        $patternRepository = $manager->getRepository(DarkPattern::class);

        foreach ($patterns as $data) {

            $existingPattern = $patternRepository->findOneBy([
                'name' => $data['name']
            ]);

            if ($existingPattern) {
                continue;
            }

            $category = $categoryRepository->findOneBy([
                'name' => $data['category']
            ]);

            if (!$category) {
                throw new \Exception(
                    'Categoria non trovata: ' . $data['category']
                );
            }

            $pattern = new DarkPattern();
            $pattern->setName($data['name']);
            $pattern->setDescription($data['description']);
            $pattern->setCategory($category);

            $manager->persist($pattern);
        }

        $manager->flush();


        // 4. ASSOCIAZIONE TRA DARK PATTERN E CARATTERISTICHE

        $associations = [
            'Confirmshaming' => ['Asymmetric'],
            'Hard to Cancel' => ['Restrictive'],
        ];

        foreach ($associations as $patternName => $characteristicNames) {

            $pattern = $patternRepository->findOneBy([
                'name' => $patternName
            ]);

            if (!$pattern) {
                throw new \Exception(
                    'Dark pattern non trovato: ' . $patternName
                );
            }

            foreach ($characteristicNames as $characteristicName) {

                $characteristic = $characteristicRepository->findOneBy([
                    'name' => $characteristicName
                ]);

                if (!$characteristic) {
                    throw new \Exception(
                        'Caratteristica non trovata: ' . $characteristicName
                    );
                }

                $pattern->addCharacteristic($characteristic);
            }
        }

        $manager->flush();
    }
}
