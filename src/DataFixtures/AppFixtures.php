<?php

namespace App\DataFixtures;

use App\Entity\DarkPattern;
use App\Entity\DarkPatternCategory;
use App\Entity\DarkPatternCharacteristic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\DetectionRule;

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
                // 5. REGOLE DI RILEVAMENTO (DETECTION RULES)

        $detectionRules = [
            [
                'pattern' => 'Sneak into Basket',
                'name' => 'Rilevamento aggiunta automatica al carrello',
                'description' => 'Individua prodotti o servizi aggiunti al carrello senza una scelta esplicita dell’utente.',
                'analysisType' => 'DOM + Behavioral',
                'detectionCondition' => 'Rilevare se un prodotto, servizio o componente aggiuntivo compare nel carrello senza che l’utente abbia effettuato un’azione esplicita per aggiungerlo. Confrontare il contenuto del carrello prima e dopo le interazioni.',
                'exclusions' => 'Escludere prodotti aggiunti volontariamente, configurazioni richieste dall’utente e componenti inclusi chiaramente nel prodotto selezionato.',
                'limitations' => 'Richiede l’osservazione delle interazioni e dello stato del carrello. La sola presenza di un prodotto nel carrello non dimostra un’aggiunta automatica.'
            ],
            [
                'pattern' => 'Hidden Costs',
                'name' => 'Rilevamento costi aggiuntivi tardivi',
                'description' => 'Individua costi aggiuntivi che emergono soltanto nelle fasi avanzate del processo di acquisto.',
                'analysisType' => 'DOM + Behavioral',
                'detectionCondition' => 'Confrontare i prezzi e le informazioni economiche mostrate nelle diverse fasi del checkout. Segnalare costi obbligatori aggiunti successivamente, come commissioni, spese di servizio o costi di gestione.',
                'exclusions' => 'Escludere costi opzionali selezionati dall’utente e spese chiaramente comunicate prima dell’inizio del checkout.',
                'limitations' => 'Richiede il confronto tra più schermate del processo di acquisto. Alcuni costi possono dipendere dalla destinazione o dalle scelte dell’utente.'
            ],
            [
                'pattern' => 'Hidden Subscription',
                'name' => 'Rilevamento abbonamenti poco evidenti',
                'description' => 'Individua condizioni di abbonamento o pagamenti ricorrenti comunicati in modo poco visibile.',
                'analysisType' => 'Text + Semantic + DOM',
                'detectionCondition' => 'Individuare riferimenti a rinnovi automatici, periodi di prova, pagamenti ricorrenti e trasformazione di una prova gratuita in un abbonamento. Verificare la visibilità di queste informazioni rispetto al prezzo iniziale e all’azione di conferma.',
                'exclusions' => 'Escludere abbonamenti chiaramente descritti, con prezzo, frequenza di pagamento e condizioni di rinnovo facilmente individuabili.',
                'limitations' => 'La presenza di termini come abbonamento o rinnovo non è sufficiente a dimostrare un inganno. È necessario valutare il contesto e la presentazione delle informazioni.'
            ],
            [
                'pattern' => 'Countdown Timer',
                'name' => 'Rilevamento timer di conto alla rovescia',
                'description' => 'Individua timer utilizzati per comunicare una scadenza imminente e accelerare la decisione dell’utente.',
                'analysisType' => 'DOM + Behavioral',
                'detectionCondition' => 'Individuare elementi che mostrano un conto alla rovescia associato a un’offerta o a una scadenza. Monitorare il timer per verificare eventuali azzeramenti, ripartenze o permanenza dell’offerta dopo la scadenza.',
                'exclusions' => 'Escludere timer relativi a scadenze effettive e verificabili, come la fine di una prenotazione o una vendita con termine reale.',
                'limitations' => 'Un timer non dimostra da solo una falsa urgenza. Per verificarne l’attendibilità occorrono osservazioni ripetute e controlli successivi alla scadenza.'
            ],
            [
                'pattern' => 'Limited-time Message',
                'name' => 'Rilevamento messaggi di tempo limitato',
                'description' => 'Individua messaggi che presentano un’offerta come disponibile soltanto per un periodo limitato.',
                'analysisType' => 'Text + Semantic',
                'detectionCondition' => 'Individuare espressioni che comunicano una disponibilità temporale limitata, come "solo per oggi", "offerta in scadenza", "ultime ore" o formulazioni semanticamente equivalenti. Valutare la presenza di informazioni verificabili sulla scadenza.',
                'exclusions' => 'Escludere comunicazioni con una scadenza esplicita, coerente e verificabile.',
                'limitations' => 'Il linguaggio di urgenza può essere espresso con formulazioni molto diverse. L’individuazione semantica può produrre falsi positivi e non permette da sola di verificare la reale scadenza.'
            ],
            [
                'pattern' => 'Confirmshaming',
                'name' => 'Rilevamento messaggi di colpevolizzazione',
                'description' => 'Individua messaggi che utilizzano senso di colpa, vergogna o giudizi negativi per condizionare il rifiuto di un’opzione.',
                'analysisType' => 'Text + Semantic',
                'detectionCondition' => 'Analizzare le etichette e i messaggi associati alle opzioni di accettazione e rifiuto. Segnalare formulazioni che associano il rifiuto a comportamenti negativi, scarsa intelligenza o perdita di opportunità.',
                'exclusions' => 'Escludere messaggi neutrali che descrivono semplicemente le conseguenze delle diverse opzioni.',
                'limitations' => 'Il tono comunicativo dipende dal contesto e dalla lingua. L’ironia e il sarcasmo possono rendere difficile la classificazione automatica.'
            ],
            [
                'pattern' => 'Visual Interference',
                'name' => 'Rilevamento interferenze visive tra opzioni',
                'description' => 'Individua differenze visive nella presentazione delle opzioni che possono favorire una scelta rispetto a un’altra.',
                'analysisType' => 'Visual + DOM',
                'detectionCondition' => 'Confrontare dimensioni, colori, contrasto, posizione, visibilità e gerarchia degli elementi interattivi. Segnalare differenze marcate tra opzioni equivalenti, come un pulsante di accettazione molto evidente rispetto a un’opzione di rifiuto poco visibile.',
                'exclusions' => 'Escludere differenze giustificate da una gerarchia funzionale chiara o da esigenze di accessibilità e usabilità.',
                'limitations' => 'L’analisi richiede informazioni visive e contestuali. Una differenza estetica non costituisce automaticamente un’interferenza manipolativa.'
            ],
            [
                'pattern' => 'Trick Questions',
                'name' => 'Rilevamento domande ambigue e fuorvianti',
                'description' => 'Individua domande o formulazioni che possono indurre l’utente a compiere una scelta diversa da quella desiderata.',
                'analysisType' => 'Text + Semantic + DOM',
                'detectionCondition' => 'Analizzare domande, checkbox e relative etichette. Individuare negazioni, doppi negativi, formulazioni ambigue e corrispondenze poco chiare tra testo e azione richiesta.',
                'exclusions' => 'Escludere formulazioni complesse ma grammaticalmente chiare, accompagnate da opzioni esplicite e non ambigue.',
                'limitations' => 'L’ambiguità dipende dalla lingua e dal contesto. È necessaria una valutazione semantica della relazione tra domanda, opzione e conseguenza.'
            ],
            [
                'pattern' => 'Pressured Selling',
                'name' => 'Rilevamento tecniche di vendita pressanti',
                'description' => 'Individua elementi che esercitano pressione sull’utente per spingerlo ad acquistare prodotti o servizi aggiuntivi.',
                'analysisType' => 'Text + Semantic + DOM',
                'detectionCondition' => 'Individuare messaggi insistenti, proposte aggiuntive ripetute, opzioni preselezionate e formulazioni che suggeriscono che un acquisto aggiuntivo sia necessario o fortemente consigliato.',
                'exclusions' => 'Escludere suggerimenti pertinenti, facoltativi e presentati in modo trasparente, senza ostacolare il completamento dell’azione principale.',
                'limitations' => 'La pressione commerciale è in parte soggettiva. È necessario considerare frequenza, contesto e modalità di presentazione delle proposte.'
            ],
            [
                'pattern' => 'Activity Message',
                'name' => 'Rilevamento notifiche di attività di altri utenti',
                'description' => 'Individua messaggi che comunicano presunte attività di acquisto, visualizzazione o interesse da parte di altri utenti.',
                'analysisType' => 'Text + Semantic + DOM',
                'detectionCondition' => 'Individuare notifiche come "Mario ha appena acquistato", "15 persone stanno visualizzando questo prodotto" o formulazioni semanticamente equivalenti. Rilevare la presenza di quantità, nomi, eventi e riferimenti temporali.',
                'exclusions' => 'Escludere statistiche aggregate e informazioni documentate, presentate chiaramente come dati storici o aggiornati.',
                'limitations' => 'La presenza della notifica non consente di verificare se l’attività dichiarata sia reale. La verifica richiede l’accesso alla fonte dei dati.'
            ],
            [
                'pattern' => 'Testimonials',
                'name' => 'Rilevamento testimonianze di origine incerta',
                'description' => 'Individua testimonianze e recensioni utilizzate per influenzare la fiducia dell’utente, la cui provenienza non è chiaramente identificabile.',
                'analysisType' => 'Text + Semantic + DOM',
                'detectionCondition' => 'Individuare testimonianze, citazioni e recensioni prive di informazioni verificabili sull’autore, sulla provenienza o sul contesto dell’esperienza. Rilevare eventuali attribuzioni generiche o assenti.',
                'exclusions' => 'Escludere testimonianze corredate da informazioni chiare e verificabili sulla loro provenienza.',
                'limitations' => 'L’assenza di informazioni sull’autore non dimostra che una testimonianza sia falsa. La verifica dell’autenticità richiede fonti esterne.'
            ],
            [
                'pattern' => 'Low-stock Message',
                'name' => 'Rilevamento messaggi di scarsa disponibilità',
                'description' => 'Individua messaggi che comunicano una disponibilità limitata di prodotti o servizi.',
                'analysisType' => 'Text + Semantic',
                'detectionCondition' => 'Individuare espressioni come "solo 2 pezzi rimasti", "ultime unità disponibili", "quasi esaurito" o formulazioni semanticamente equivalenti.',
                'exclusions' => 'Escludere informazioni di disponibilità collegate a dati di magazzino aggiornati e verificabili.',
                'limitations' => 'Il sistema può individuare il messaggio ma non verificarne autonomamente la veridicità. È necessario confrontarlo con informazioni reali sulla disponibilità.'
            ],
            [
                'pattern' => 'High-demand Message',
                'name' => 'Rilevamento messaggi di domanda elevata',
                'description' => 'Individua messaggi che comunicano un’elevata domanda o un forte interesse verso un prodotto o servizio.',
                'analysisType' => 'Text + Semantic',
                'detectionCondition' => 'Individuare espressioni come "molto richiesto", "molte persone sono interessate", "prodotto popolare" o formulazioni semanticamente equivalenti.',
                'exclusions' => 'Escludere comunicazioni supportate da dati attendibili e contestualizzati sulla domanda effettiva.',
                'limitations' => 'Il rilevamento linguistico non permette di verificare il numero reale di utenti interessati o la correttezza delle informazioni dichiarate.'
            ],
            [
                'pattern' => 'Hard to Cancel',
                'name' => 'Rilevamento ostacoli alla cancellazione',
                'description' => 'Individua elementi dell’interfaccia che rendono la cancellazione di un servizio più difficile rispetto alla sua attivazione.',
                'analysisType' => 'DOM + Behavioral',
                'detectionCondition' => 'Analizzare il percorso di cancellazione, individuando passaggi eccessivi, navigazione complessa, pulsanti difficili da trovare, richieste ripetute di conferma e ostacoli non presenti nel processo di iscrizione.',
                'exclusions' => 'Escludere procedure necessarie per verificare l’identità dell’utente o adempiere a obblighi tecnici e normativi, purché proporzionate.',
                'limitations' => 'Richiede il confronto tra il percorso di iscrizione e quello di cancellazione. L’analisi di una singola schermata non è sufficiente.'
            ],
            [
                'pattern' => 'Forced Enrollment',
                'name' => 'Rilevamento registrazione obbligatoria',
                'description' => 'Individua situazioni in cui l’utente è obbligato a registrarsi o creare un account per completare un’azione.',
                'analysisType' => 'DOM + Behavioral',
                'detectionCondition' => 'Verificare se la creazione di un account o la registrazione sono condizioni obbligatorie per completare un’attività che potrebbe essere disponibile senza registrazione. Individuare l’assenza di alternative come il checkout ospite.',
                'exclusions' => 'Escludere servizi per i quali la registrazione è effettivamente necessaria al funzionamento, alla sicurezza o alla gestione dell’attività richiesta.',
                'limitations' => 'Il sistema non può stabilire automaticamente se la registrazione sia realmente necessaria. Occorre valutare la funzione del servizio e le alternative disponibili.'
            ],
        ];

        $detectionRuleRepository = $manager->getRepository(DetectionRule::class);

        foreach ($detectionRules as $data) {

            // Recupera il Dark Pattern a cui associare la regola
            $pattern = $patternRepository->findOneBy([
                'name' => $data['pattern']
            ]);

            if (!$pattern) {
                throw new \Exception(
                    'Dark Pattern non trovato: ' . $data['pattern']
                );
            }

            // Controlla se la regola esiste già per questo Dark Pattern
            $existingRule = $detectionRuleRepository->findOneBy([
                'name' => $data['name'],
                'darkPattern' => $pattern
            ]);

            if ($existingRule) {
                continue;
            }

            // Crea una nuova regola di rilevamento
            $rule = new DetectionRule();

            $rule->setName($data['name']);
            $rule->setDescription($data['description']);
            $rule->setAnalysisType($data['analysisType']);
            $rule->setDetectionCondition($data['detectionCondition']);
            $rule->setExclusions($data['exclusions']);
            $rule->setLimitations($data['limitations']);

            // Collega la regola al relativo Dark Pattern
            $rule->setDarkPattern($pattern);

            $manager->persist($rule);
        }

        // Salva tutte le regole nel database
        $manager->flush();
    }
}
