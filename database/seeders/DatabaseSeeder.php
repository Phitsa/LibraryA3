<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Livro;
use App\Models\Usuario;
use App\Models\Emprestimo;
use App\Models\Reserva;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================================================
        // 80 LIVROS
        // =====================================================================
        $livros = [
            // ROMANCE
            ['titulo' => 'Dom Casmurro',                       'autor' => 'Machado de Assis',          'isbn' => '978-8525406958', 'quantidade_total' => 5, 'quantidade_disponivel' => 2, 'categoria' => 'Romance'],
            ['titulo' => 'Memórias Póstumas de Brás Cubas',    'autor' => 'Machado de Assis',          'isbn' => '978-8525406941', 'quantidade_total' => 4, 'quantidade_disponivel' => 3, 'categoria' => 'Romance'],
            ['titulo' => 'Quincas Borba',                      'autor' => 'Machado de Assis',          'isbn' => '978-8535901900', 'quantidade_total' => 3, 'quantidade_disponivel' => 3, 'categoria' => 'Romance'],
            ['titulo' => 'Grande Sertão: Veredas',             'autor' => 'João Guimarães Rosa',       'isbn' => '978-8526011243', 'quantidade_total' => 4, 'quantidade_disponivel' => 1, 'categoria' => 'Romance'],
            ['titulo' => 'A Hora da Estrela',                  'autor' => 'Clarice Lispector',         'isbn' => '978-8532520531', 'quantidade_total' => 5, 'quantidade_disponivel' => 4, 'categoria' => 'Romance'],
            ['titulo' => 'A Paixão Segundo G.H.',              'autor' => 'Clarice Lispector',         'isbn' => '978-8532520593', 'quantidade_total' => 3, 'quantidade_disponivel' => 2, 'categoria' => 'Romance'],
            ['titulo' => 'Vidas Secas',                        'autor' => 'Graciliano Ramos',          'isbn' => '978-8535902891', 'quantidade_total' => 4, 'quantidade_disponivel' => 0, 'categoria' => 'Romance'],
            ['titulo' => 'São Bernardo',                       'autor' => 'Graciliano Ramos',          'isbn' => '978-8535901030', 'quantidade_total' => 3, 'quantidade_disponivel' => 2, 'categoria' => 'Romance'],
            ['titulo' => 'O Cortiço',                          'autor' => 'Aluísio Azevedo',           'isbn' => '978-8535905410', 'quantidade_total' => 4, 'quantidade_disponivel' => 3, 'categoria' => 'Romance'],
            ['titulo' => 'Iracema',                            'autor' => 'José de Alencar',           'isbn' => '978-8508178131', 'quantidade_total' => 3, 'quantidade_disponivel' => 3, 'categoria' => 'Romance'],
            ['titulo' => 'O Guarani',                          'autor' => 'José de Alencar',           'isbn' => '978-8508178148', 'quantidade_total' => 2, 'quantidade_disponivel' => 1, 'categoria' => 'Romance'],
            ['titulo' => 'Capitães da Areia',                  'autor' => 'Jorge Amado',               'isbn' => '978-8528614893', 'quantidade_total' => 5, 'quantidade_disponivel' => 2, 'categoria' => 'Romance'],
            ['titulo' => 'Gabriela, Cravo e Canela',           'autor' => 'Jorge Amado',               'isbn' => '978-8528614909', 'quantidade_total' => 4, 'quantidade_disponivel' => 3, 'categoria' => 'Romance'],
            ['titulo' => 'Tereza Batista',                     'autor' => 'Jorge Amado',               'isbn' => '978-8528614916', 'quantidade_total' => 3, 'quantidade_disponivel' => 2, 'categoria' => 'Romance'],
            ['titulo' => 'A Moreninha',                        'autor' => 'Joaquim Manuel de Macedo',  'isbn' => '978-8508173457', 'quantidade_total' => 2, 'quantidade_disponivel' => 2, 'categoria' => 'Romance'],

            // FICÇÃO CIENTÍFICA
            ['titulo' => 'A Revolução dos Bichos',             'autor' => 'George Orwell',             'isbn' => '978-8535909555', 'quantidade_total' => 5, 'quantidade_disponivel' => 0, 'categoria' => 'Ficção Científica'],
            ['titulo' => '1984',                               'autor' => 'George Orwell',             'isbn' => '978-8535914849', 'quantidade_total' => 6, 'quantidade_disponivel' => 1, 'categoria' => 'Ficção Científica'],
            ['titulo' => 'Admirável Mundo Novo',               'autor' => 'Aldous Huxley',             'isbn' => '978-8535902774', 'quantidade_total' => 4, 'quantidade_disponivel' => 0, 'categoria' => 'Ficção Científica'],
            ['titulo' => 'Fahrenheit 451',                     'autor' => 'Ray Bradbury',              'isbn' => '978-8532520427', 'quantidade_total' => 3, 'quantidade_disponivel' => 1, 'categoria' => 'Ficção Científica'],
            ['titulo' => 'Fundação',                           'autor' => 'Isaac Asimov',              'isbn' => '978-8576573371', 'quantidade_total' => 4, 'quantidade_disponivel' => 2, 'categoria' => 'Ficção Científica'],
            ['titulo' => 'Eu, Robô',                           'autor' => 'Isaac Asimov',              'isbn' => '978-8576573388', 'quantidade_total' => 3, 'quantidade_disponivel' => 1, 'categoria' => 'Ficção Científica'],
            ['titulo' => 'Duna',                               'autor' => 'Frank Herbert',             'isbn' => '978-8576573036', 'quantidade_total' => 5, 'quantidade_disponivel' => 2, 'categoria' => 'Ficção Científica'],
            ['titulo' => 'Neuromancer',                        'autor' => 'William Gibson',            'isbn' => '978-8576573692', 'quantidade_total' => 3, 'quantidade_disponivel' => 2, 'categoria' => 'Ficção Científica'],
            ['titulo' => 'O Guia do Mochileiro das Galáxias',  'autor' => 'Douglas Adams',             'isbn' => '978-8599296523', 'quantidade_total' => 4, 'quantidade_disponivel' => 3, 'categoria' => 'Ficção Científica'],
            ['titulo' => 'Ender: O Jogo',                      'autor' => 'Orson Scott Card',          'isbn' => '978-8576573050', 'quantidade_total' => 3, 'quantidade_disponivel' => 1, 'categoria' => 'Ficção Científica'],

            // FANTASIA
            ['titulo' => 'O Senhor dos Anéis: A Sociedade do Anel', 'autor' => 'J.R.R. Tolkien',      'isbn' => '978-8533613379', 'quantidade_total' => 5, 'quantidade_disponivel' => 2, 'categoria' => 'Fantasia'],
            ['titulo' => 'O Senhor dos Anéis: As Duas Torres',      'autor' => 'J.R.R. Tolkien',      'isbn' => '978-8533613386', 'quantidade_total' => 4, 'quantidade_disponivel' => 3, 'categoria' => 'Fantasia'],
            ['titulo' => 'O Senhor dos Anéis: O Retorno do Rei',    'autor' => 'J.R.R. Tolkien',      'isbn' => '978-8533613393', 'quantidade_total' => 4, 'quantidade_disponivel' => 2, 'categoria' => 'Fantasia'],
            ['titulo' => 'O Hobbit',                           'autor' => 'J.R.R. Tolkien',           'isbn' => '978-8533613409', 'quantidade_total' => 6, 'quantidade_disponivel' => 4, 'categoria' => 'Fantasia'],
            ['titulo' => 'Harry Potter e a Pedra Filosofal',   'autor' => 'J.K. Rowling',             'isbn' => '978-8532511010', 'quantidade_total' => 8, 'quantidade_disponivel' => 3, 'categoria' => 'Fantasia'],
            ['titulo' => 'Harry Potter e a Câmara Secreta',    'autor' => 'J.K. Rowling',             'isbn' => '978-8532511027', 'quantidade_total' => 6, 'quantidade_disponivel' => 4, 'categoria' => 'Fantasia'],
            ['titulo' => 'Harry Potter e o Prisioneiro de Azkaban', 'autor' => 'J.K. Rowling',        'isbn' => '978-8532511034', 'quantidade_total' => 5, 'quantidade_disponivel' => 2, 'categoria' => 'Fantasia'],
            ['titulo' => 'As Crônicas de Nárnia',              'autor' => 'C.S. Lewis',               'isbn' => '978-8578277987', 'quantidade_total' => 4, 'quantidade_disponivel' => 3, 'categoria' => 'Fantasia'],
            ['titulo' => 'O Nome do Vento',                    'autor' => 'Patrick Rothfuss',         'isbn' => '978-8576572701', 'quantidade_total' => 3, 'quantidade_disponivel' => 0, 'categoria' => 'Fantasia'],

            // TÉCNICO
            ['titulo' => 'Clean Code',                         'autor' => 'Robert C. Martin',         'isbn' => '978-0132350884', 'quantidade_total' => 5, 'quantidade_disponivel' => 1, 'categoria' => 'Técnico'],
            ['titulo' => 'The Pragmatic Programmer',           'autor' => 'Andrew Hunt',              'isbn' => '978-0135957059', 'quantidade_total' => 4, 'quantidade_disponivel' => 2, 'categoria' => 'Técnico'],
            ['titulo' => 'Estrutura de Dados em C',            'autor' => 'Waldemar Celes',           'isbn' => '978-8535212280', 'quantidade_total' => 6, 'quantidade_disponivel' => 3, 'categoria' => 'Técnico'],
            ['titulo' => 'Algoritmos: Teoria e Prática',       'autor' => 'Thomas H. Cormen',         'isbn' => '978-8535236996', 'quantidade_total' => 5, 'quantidade_disponivel' => 2, 'categoria' => 'Técnico'],
            ['titulo' => 'Design Patterns',                    'autor' => 'Gang of Four',             'isbn' => '978-0201633610', 'quantidade_total' => 3, 'quantidade_disponivel' => 1, 'categoria' => 'Técnico'],
            ['titulo' => 'Arquitetura Limpa',                  'autor' => 'Robert C. Martin',         'isbn' => '978-8550804606', 'quantidade_total' => 4, 'quantidade_disponivel' => 2, 'categoria' => 'Técnico'],
            ['titulo' => 'Domain-Driven Design',               'autor' => 'Eric Evans',               'isbn' => '978-0321125217', 'quantidade_total' => 3, 'quantidade_disponivel' => 1, 'categoria' => 'Técnico'],
            ['titulo' => 'Sistemas Operacionais Modernos',     'autor' => 'Andrew Tanenbaum',         'isbn' => '978-8576052371', 'quantidade_total' => 4, 'quantidade_disponivel' => 3, 'categoria' => 'Técnico'],
            ['titulo' => 'Redes de Computadores',              'autor' => 'Andrew Tanenbaum',         'isbn' => '978-8576052388', 'quantidade_total' => 4, 'quantidade_disponivel' => 2, 'categoria' => 'Técnico'],
            ['titulo' => 'Banco de Dados: Projeto e Implementação', 'autor' => 'Felipe Nery Rodrigues', 'isbn' => '978-8536500102', 'quantidade_total' => 5, 'quantidade_disponivel' => 3, 'categoria' => 'Técnico'],

            // HISTÓRIA
            ['titulo' => 'Sapiens: Uma Breve História da Humanidade', 'autor' => 'Yuval Noah Harari', 'isbn' => '978-8535922851', 'quantidade_total' => 6, 'quantidade_disponivel' => 3, 'categoria' => 'História'],
            ['titulo' => 'Homo Deus',                          'autor' => 'Yuval Noah Harari',        'isbn' => '978-8535928099', 'quantidade_total' => 4, 'quantidade_disponivel' => 2, 'categoria' => 'História'],
            ['titulo' => '21 Lições para o Século 21',         'autor' => 'Yuval Noah Harari',        'isbn' => '978-8535930894', 'quantidade_total' => 3, 'quantidade_disponivel' => 1, 'categoria' => 'História'],
            ['titulo' => 'O Mundo Assombrado pelos Demônios',  'autor' => 'Carl Sagan',               'isbn' => '978-8535924435', 'quantidade_total' => 4, 'quantidade_disponivel' => 2, 'categoria' => 'História'],
            ['titulo' => 'Uma História do Mundo em 12 Mapas',  'autor' => 'Jerry Brotton',            'isbn' => '978-8535925746', 'quantidade_total' => 2, 'quantidade_disponivel' => 1, 'categoria' => 'História'],
            ['titulo' => 'Armas, Germes e Aço',                'autor' => 'Jared Diamond',            'isbn' => '978-8535923773', 'quantidade_total' => 3, 'quantidade_disponivel' => 2, 'categoria' => 'História'],
            ['titulo' => 'A Origem das Espécies',              'autor' => 'Charles Darwin',           'isbn' => '978-8579302008', 'quantidade_total' => 3, 'quantidade_disponivel' => 3, 'categoria' => 'História'],

            // FILOSOFIA
            ['titulo' => 'O Pequeno Príncipe',                 'autor' => 'Antoine de Saint-Exupéry', 'isbn' => '978-8574068312', 'quantidade_total' => 8, 'quantidade_disponivel' => 5, 'categoria' => 'Filosofia'],
            ['titulo' => 'A República',                        'autor' => 'Platão',                   'isbn' => '978-8572832762', 'quantidade_total' => 4, 'quantidade_disponivel' => 3, 'categoria' => 'Filosofia'],
            ['titulo' => 'Ética a Nicômaco',                   'autor' => 'Aristóteles',              'isbn' => '978-8572832779', 'quantidade_total' => 3, 'quantidade_disponivel' => 2, 'categoria' => 'Filosofia'],
            ['titulo' => 'Meditações',                         'autor' => 'Marco Aurélio',            'isbn' => '978-8535924459', 'quantidade_total' => 4, 'quantidade_disponivel' => 3, 'categoria' => 'Filosofia'],
            ['titulo' => 'O Ser e o Nada',                     'autor' => 'Jean-Paul Sartre',         'isbn' => '978-8532624871', 'quantidade_total' => 2, 'quantidade_disponivel' => 1, 'categoria' => 'Filosofia'],
            ['titulo' => 'Assim Falou Zaratustra',             'autor' => 'Friedrich Nietzsche',      'isbn' => '978-8535919905', 'quantidade_total' => 3, 'quantidade_disponivel' => 2, 'categoria' => 'Filosofia'],
            ['titulo' => 'Crítica da Razão Pura',              'autor' => 'Immanuel Kant',            'isbn' => '978-8572832786', 'quantidade_total' => 2, 'quantidade_disponivel' => 1, 'categoria' => 'Filosofia'],
            ['titulo' => 'O Contrato Social',                  'autor' => 'Jean-Jacques Rousseau',    'isbn' => '978-8572832793', 'quantidade_total' => 3, 'quantidade_disponivel' => 2, 'categoria' => 'Filosofia'],

            // AUTOAJUDA / NEGÓCIOS
            ['titulo' => 'O Poder do Hábito',                  'autor' => 'Charles Duhigg',           'isbn' => '978-8539004119', 'quantidade_total' => 5, 'quantidade_disponivel' => 3, 'categoria' => 'Autoajuda'],
            ['titulo' => 'Mindset: A Nova Psicologia do Sucesso', 'autor' => 'Carol S. Dweck',        'isbn' => '978-8543107172', 'quantidade_total' => 4, 'quantidade_disponivel' => 2, 'categoria' => 'Autoajuda'],
            ['titulo' => 'A Startup Enxuta',                   'autor' => 'Eric Ries',                'isbn' => '978-8581780788', 'quantidade_total' => 3, 'quantidade_disponivel' => 1, 'categoria' => 'Autoajuda'],
            ['titulo' => 'De Zero a Um',                       'autor' => 'Peter Thiel',              'isbn' => '978-8542211535', 'quantidade_total' => 4, 'quantidade_disponivel' => 2, 'categoria' => 'Autoajuda'],
            ['titulo' => 'O Homem Mais Rico da Babilônia',     'autor' => 'George S. Clason',         'isbn' => '978-8595081406', 'quantidade_total' => 5, 'quantidade_disponivel' => 4, 'categoria' => 'Autoajuda'],
            ['titulo' => 'Pai Rico, Pai Pobre',                'autor' => 'Robert T. Kiyosaki',       'isbn' => '978-8595081413', 'quantidade_total' => 6, 'quantidade_disponivel' => 3, 'categoria' => 'Autoajuda'],
            ['titulo' => 'Como Fazer Amigos e Influenciar Pessoas', 'autor' => 'Dale Carnegie',       'isbn' => '978-8543107424', 'quantidade_total' => 5, 'quantidade_disponivel' => 3, 'categoria' => 'Autoajuda'],

            // BIOGRAFIA
            ['titulo' => 'Steve Jobs',                         'autor' => 'Walter Isaacson',          'isbn' => '978-8535920154', 'quantidade_total' => 4, 'quantidade_disponivel' => 1, 'categoria' => 'Biografia'],
            ['titulo' => 'Elon Musk',                          'autor' => 'Walter Isaacson',          'isbn' => '978-8535935745', 'quantidade_total' => 5, 'quantidade_disponivel' => 2, 'categoria' => 'Biografia'],
            ['titulo' => 'O Diário de Anne Frank',             'autor' => 'Anne Frank',               'isbn' => '978-8506082553', 'quantidade_total' => 6, 'quantidade_disponivel' => 4, 'categoria' => 'Biografia'],
            ['titulo' => 'Em Busca de Sentido',                'autor' => 'Viktor E. Frankl',         'isbn' => '978-8532620040', 'quantidade_total' => 4, 'quantidade_disponivel' => 2, 'categoria' => 'Biografia'],
            ['titulo' => 'Leonardo da Vinci',                  'autor' => 'Walter Isaacson',          'isbn' => '978-8535932515', 'quantidade_total' => 3, 'quantidade_disponivel' => 1, 'categoria' => 'Biografia'],

            // POESIA
            ['titulo' => 'Alguma Poesia',                      'autor' => 'Carlos Drummond de Andrade', 'isbn' => '978-8535900316', 'quantidade_total' => 3, 'quantidade_disponivel' => 2, 'categoria' => 'Poesia'],
            ['titulo' => 'Claro Enigma',                       'autor' => 'Carlos Drummond de Andrade', 'isbn' => '978-8535900323', 'quantidade_total' => 2, 'quantidade_disponivel' => 2, 'categoria' => 'Poesia'],
            ['titulo' => 'Mar Absoluto',                       'autor' => 'Cecília Meireles',         'isbn' => '978-8535900330', 'quantidade_total' => 2, 'quantidade_disponivel' => 1, 'categoria' => 'Poesia'],
            ['titulo' => 'Libertinagem',                       'autor' => 'Manuel Bandeira',          'isbn' => '978-8535900347', 'quantidade_total' => 2, 'quantidade_disponivel' => 2, 'categoria' => 'Poesia'],
            ['titulo' => 'Mensagem',                           'autor' => 'Fernando Pessoa',          'isbn' => '978-8535900354', 'quantidade_total' => 3, 'quantidade_disponivel' => 2, 'categoria' => 'Poesia'],
        ];

        foreach ($livros as $livro) {
            Livro::create($livro);
        }

        // =====================================================================
        // 40 USUÁRIOS
        // =====================================================================
        $usuarios = [
            ['nome' => 'Ana Beatriz Costa',        'email' => 'ana.costa@email.com',        'matricula' => '2024001'],
            ['nome' => 'Bruno Fernandes',           'email' => 'bruno.f@email.com',          'matricula' => '2024002'],
            ['nome' => 'Carla Mendes',              'email' => 'carla.m@email.com',          'matricula' => '2024003'],
            ['nome' => 'Daniel Oliveira',           'email' => 'daniel.o@email.com',         'matricula' => '2024004'],
            ['nome' => 'Eduarda Santos',            'email' => 'eduarda.s@email.com',        'matricula' => '2024005'],
            ['nome' => 'Felipe Rocha',              'email' => 'felipe.r@email.com',         'matricula' => '2024006'],
            ['nome' => 'Gabriela Lima',             'email' => 'gabriela.l@email.com',       'matricula' => '2024007'],
            ['nome' => 'Henrique Alves',            'email' => 'henrique.a@email.com',       'matricula' => '2024008'],
            ['nome' => 'Isabela Ferreira',          'email' => 'isabela.f@email.com',        'matricula' => '2024009'],
            ['nome' => 'João Pedro Nascimento',     'email' => 'joao.p@email.com',           'matricula' => '2024010'],
            ['nome' => 'Karen Souza',               'email' => 'karen.s@email.com',          'matricula' => '2024011'],
            ['nome' => 'Lucas Martins',             'email' => 'lucas.m@email.com',          'matricula' => '2024012'],
            ['nome' => 'Mariana Barbosa',           'email' => 'mariana.b@email.com',        'matricula' => '2024013'],
            ['nome' => 'Nicolas Pereira',           'email' => 'nicolas.p@email.com',        'matricula' => '2024014'],
            ['nome' => 'Olívia Cardoso',            'email' => 'olivia.c@email.com',         'matricula' => '2024015'],
            ['nome' => 'Pedro Augusto Ribeiro',     'email' => 'pedro.a@email.com',          'matricula' => '2024016'],
            ['nome' => 'Queila Monteiro',           'email' => 'queila.m@email.com',         'matricula' => '2024017'],
            ['nome' => 'Rafael Cunha',              'email' => 'rafael.c@email.com',         'matricula' => '2024018'],
            ['nome' => 'Sara Pinto',                'email' => 'sara.p@email.com',           'matricula' => '2024019'],
            ['nome' => 'Thiago Azevedo',            'email' => 'thiago.a@email.com',         'matricula' => '2024020'],
            ['nome' => 'Ursula Teixeira',           'email' => 'ursula.t@email.com',         'matricula' => '2024021'],
            ['nome' => 'Vinícius Gomes',            'email' => 'vinicius.g@email.com',       'matricula' => '2024022'],
            ['nome' => 'Wendy Cavalcanti',          'email' => 'wendy.c@email.com',          'matricula' => '2024023'],
            ['nome' => 'Ximena Rodrigues',          'email' => 'ximena.r@email.com',         'matricula' => '2024024'],
            ['nome' => 'Yago Freitas',              'email' => 'yago.f@email.com',           'matricula' => '2024025'],
            ['nome' => 'Zara Moreira',              'email' => 'zara.m@email.com',           'matricula' => '2024026'],
            ['nome' => 'André Lopes',               'email' => 'andre.l@email.com',          'matricula' => '2023001'],
            ['nome' => 'Beatriz Nunes',             'email' => 'beatriz.n@email.com',        'matricula' => '2023002'],
            ['nome' => 'Caio Medeiros',             'email' => 'caio.med@email.com',         'matricula' => '2023003'],
            ['nome' => 'Diana Castro',              'email' => 'diana.c@email.com',          'matricula' => '2023004'],
            ['nome' => 'Emerson Duarte',            'email' => 'emerson.d@email.com',        'matricula' => '2023005'],
            ['nome' => 'Fernanda Correia',          'email' => 'fernanda.cor@email.com',     'matricula' => '2023006'],
            ['nome' => 'Gustavo Henriques',         'email' => 'gustavo.h@email.com',        'matricula' => '2023007'],
            ['nome' => 'Helena Macedo',             'email' => 'helena.mac@email.com',       'matricula' => '2023008'],
            ['nome' => 'Igor Santana',              'email' => 'igor.san@email.com',         'matricula' => '2023009'],
            ['nome' => 'Juliana Carvalho',          'email' => 'juliana.car@email.com',      'matricula' => '2023010'],
            ['nome' => 'Kleber Fonseca',            'email' => 'kleber.f@email.com',         'matricula' => '2022001'],
            ['nome' => 'Larissa Borges',            'email' => 'larissa.b@email.com',        'matricula' => '2022002'],
            ['nome' => 'Mateus Vieira',             'email' => 'mateus.v@email.com',         'matricula' => '2022003'],
            ['nome' => 'Natália Campos',            'email' => 'natalia.cam@email.com',      'matricula' => '2022004'],
        ];

        foreach ($usuarios as $usuario) {
            Usuario::create($usuario);
        }

        // =====================================================================
        // EMPRÉSTIMOS (histórico rico e variado)
        // =====================================================================

        // Helper para criar empréstimo devolvido
        $devolvido = function(int $livroId, int $usuarioId, int $diasAtras, int $prazo = 14) {
            Emprestimo::create([
                'livro_id'                => $livroId,
                'usuario_id'              => $usuarioId,
                'data_emprestimo'         => Carbon::today()->subDays($diasAtras + $prazo),
                'data_devolucao_prevista' => Carbon::today()->subDays($diasAtras),
                'data_devolucao_real'     => Carbon::today()->subDays($diasAtras + rand(0, 5)),
                'status'                  => 'devolvido',
            ]);
        };

        // Helper para criar empréstimo ativo (no prazo)
        $ativo = function(int $livroId, int $usuarioId, int $diasEmprestado) {
            Emprestimo::create([
                'livro_id'                => $livroId,
                'usuario_id'             => $usuarioId,
                'data_emprestimo'         => Carbon::today()->subDays($diasEmprestado),
                'data_devolucao_prevista' => Carbon::today()->subDays($diasEmprestado)->addDays(14),
                'status'                  => 'ativo',
            ]);
        };

        // Helper para criar empréstimo atrasado
        $atrasado = function(int $livroId, int $usuarioId, int $diasAtraso) {
            Emprestimo::create([
                'livro_id'                => $livroId,
                'usuario_id'             => $usuarioId,
                'data_emprestimo'         => Carbon::today()->subDays(14 + $diasAtraso),
                'data_devolucao_prevista' => Carbon::today()->subDays($diasAtraso),
                'status'                  => 'ativo',
            ]);
        };

        // --- ATIVOS (no prazo) ---
        $ativo(1,  1,  3);   // Dom Casmurro       → Ana
        $ativo(1,  2,  5);   // Dom Casmurro       → Bruno
        $ativo(1,  3,  1);   // Dom Casmurro       → Carla
        $ativo(4,  4,  7);   // Grande Sertão      → Daniel
        $ativo(5,  5,  2);   // A Hora da Estrela  → Eduarda
        $ativo(12, 6,  4);   // Capitães da Areia  → Felipe
        $ativo(12, 7,  6);   // Capitães da Areia  → Gabriela
        $ativo(12, 8,  1);   // Capitães da Areia  → Henrique
        $ativo(17, 9,  3);   // 1984               → Isabela
        $ativo(20, 10, 2);   // Fundação           → João Pedro
        $ativo(25, 11, 8);   // Ender: O Jogo      → Karen
        $ativo(34, 12, 3);   // Clean Code         → Lucas
        $ativo(35, 13, 5);   // Pragmatic Prog.    → Mariana
        $ativo(37, 14, 2);   // Algoritmos Cormen  → Nicolas
        $ativo(38, 15, 7);   // Design Patterns    → Olívia
        $ativo(39, 16, 4);   // Arquitetura Limpa  → Pedro
        $ativo(40, 17, 1);   // DDD                → Queila
        $ativo(45, 18, 6);   // Sapiens            → Rafael
        $ativo(46, 19, 3);   // Homo Deus          → Sara
        $ativo(55, 20, 2);   // O Pequeno Príncipe → Thiago
        $ativo(59, 21, 5);   // Assim Falou Zar.   → Ursula
        $ativo(62, 22, 1);   // O Poder do Hábito  → Vinícius
        $ativo(63, 23, 4);   // Mindset            → Wendy
        $ativo(67, 24, 2);   // Pai Rico Pai Pobre → Ximena
        $ativo(70, 25, 7);   // Steve Jobs         → Yago
        $ativo(71, 26, 3);   // Elon Musk          → Zara
        $ativo(29, 27, 5);   // HP Pedra Filosofal → André
        $ativo(29, 28, 2);   // HP Pedra Filosofal → Beatriz
        $ativo(29, 29, 8);   // HP Pedra Filosofal → Caio

        // --- ATRASADOS (para mostrar o alerta vermelho) ---
        $atrasado(7,  30, 3);   // Vidas Secas       → Diana (3 dias de atraso)
        $atrasado(7,  31, 5);   // Vidas Secas       → Emerson (5 dias)
        $atrasado(7,  32, 1);   // Vidas Secas       → Fernanda (1 dia)
        $atrasado(7,  33, 8);   // Vidas Secas       → Gustavo (8 dias)
        $atrasado(16, 34, 4);   // A Revolução dos Bichos → Helena
        $atrasado(16, 35, 2);   // A Revolução dos Bichos → Igor
        $atrasado(16, 36, 6);   // A Revolução dos Bichos → Juliana
        $atrasado(16, 37, 10);  // A Revolução dos Bichos → Kleber
        $atrasado(16, 38, 15);  // A Revolução dos Bichos → Larissa
        $atrasado(18, 39, 7);   // Admirável Mundo Novo  → Mateus
        $atrasado(18, 40, 3);   // Admirável Mundo Novo  → Natália
        $atrasado(34, 1,  2);   // Nome do Vento         → Ana
        $atrasado(43, 2,  5);   // Sistemas Operac.      → Bruno

        // --- DEVOLVIDOS (histórico) ---
        $devolvido(3,  1,  2);
        $devolvido(3,  5,  10);
        $devolvido(3,  9,  25);
        $devolvido(5,  2,  5);
        $devolvido(6,  3,  12);
        $devolvido(8,  4,  8);
        $devolvido(10, 6,  15);
        $devolvido(11, 7,  20);
        $devolvido(13, 8,  3);
        $devolvido(14, 9,  30);
        $devolvido(15, 10, 7);
        $devolvido(17, 11, 45);
        $devolvido(19, 12, 18);
        $devolvido(20, 13, 22);
        $devolvido(21, 14, 9);
        $devolvido(22, 15, 14);
        $devolvido(23, 16, 6);
        $devolvido(24, 17, 11);
        $devolvido(26, 18, 33);
        $devolvido(27, 19, 40);
        $devolvido(28, 20, 17);
        $devolvido(30, 21, 5);
        $devolvido(31, 22, 28);
        $devolvido(32, 23, 13);
        $devolvido(33, 24, 50);
        $devolvido(35, 25, 8);
        $devolvido(36, 26, 21);
        $devolvido(37, 27, 4);
        $devolvido(38, 28, 16);
        $devolvido(39, 29, 35);
        $devolvido(40, 30, 9);
        $devolvido(41, 31, 42);
        $devolvido(42, 32, 7);
        $devolvido(44, 33, 19);
        $devolvido(45, 34, 3);
        $devolvido(46, 35, 26);
        $devolvido(47, 36, 11);
        $devolvido(48, 37, 38);
        $devolvido(50, 38, 6);
        $devolvido(51, 39, 14);
        $devolvido(52, 40, 29);
        $devolvido(53, 1,  48);
        $devolvido(54, 2,  10);
        $devolvido(56, 3,  23);
        $devolvido(57, 4,  7);
        $devolvido(58, 5,  31);
        $devolvido(60, 6,  15);
        $devolvido(61, 7,  4);
        $devolvido(62, 8,  20);
        $devolvido(64, 9,  9);
        $devolvido(65, 10, 55);
        $devolvido(66, 11, 12);
        $devolvido(68, 12, 2);
        $devolvido(69, 13, 36);
        $devolvido(72, 14, 8);
        $devolvido(42, 15, 17);
        $devolvido(22, 16, 44);
        $devolvido(12, 17, 6);
        $devolvido(62, 18, 28);
        $devolvido(52, 19, 13);
        $devolvido(42, 20, 3);
        $devolvido(2,  21, 60);
        $devolvido(2,  22, 30);
        $devolvido(4,  23, 20);
        $devolvido(9,  24, 15);
        $devolvido(29, 25, 90);
        $devolvido(29, 26, 75);
        $devolvido(29, 27, 45);

        // =====================================================================
        // FILAS DE RESERVA (FIFO Queue) — para livros 100% esgotados
        // =====================================================================

        // Livro 7  — Vidas Secas (todos 4 exemplares emprestados/atrasados → qnt_disponivel=0)
        Reserva::create(['livro_id' => 7,  'usuario_id' => 1,  'posicao_fila' => 1, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 7,  'usuario_id' => 5,  'posicao_fila' => 2, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 7,  'usuario_id' => 10, 'posicao_fila' => 3, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 7,  'usuario_id' => 15, 'posicao_fila' => 4, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 7,  'usuario_id' => 20, 'posicao_fila' => 5, 'status' => 'aguardando']);

        // Livro 16 — A Revolução dos Bichos (qnt_disponivel=0)
        Reserva::create(['livro_id' => 16, 'usuario_id' => 2,  'posicao_fila' => 1, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 16, 'usuario_id' => 6,  'posicao_fila' => 2, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 16, 'usuario_id' => 11, 'posicao_fila' => 3, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 16, 'usuario_id' => 16, 'posicao_fila' => 4, 'status' => 'aguardando']);

        // Livro 18 — Admirável Mundo Novo (qnt_disponivel=0)
        Reserva::create(['livro_id' => 18, 'usuario_id' => 3,  'posicao_fila' => 1, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 18, 'usuario_id' => 7,  'posicao_fila' => 2, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 18, 'usuario_id' => 12, 'posicao_fila' => 3, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 18, 'usuario_id' => 22, 'posicao_fila' => 4, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 18, 'usuario_id' => 28, 'posicao_fila' => 5, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 18, 'usuario_id' => 34, 'posicao_fila' => 6, 'status' => 'aguardando']);

        // Livro 34 — O Nome do Vento (qnt_disponivel=0)
        Reserva::create(['livro_id' => 34, 'usuario_id' => 4,  'posicao_fila' => 1, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 34, 'usuario_id' => 8,  'posicao_fila' => 2, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 34, 'usuario_id' => 13, 'posicao_fila' => 3, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 34, 'usuario_id' => 18, 'posicao_fila' => 4, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 34, 'usuario_id' => 23, 'posicao_fila' => 5, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 34, 'usuario_id' => 29, 'posicao_fila' => 6, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 34, 'usuario_id' => 35, 'posicao_fila' => 7, 'status' => 'aguardando']);

        // Livro 17 — 1984 (qnt_disponivel=1, mas já tem fila por ser muito procurado)
        Reserva::create(['livro_id' => 17, 'usuario_id' => 9,  'posicao_fila' => 1, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 17, 'usuario_id' => 14, 'posicao_fila' => 2, 'status' => 'aguardando']);
        Reserva::create(['livro_id' => 17, 'usuario_id' => 19, 'posicao_fila' => 3, 'status' => 'aguardando']);

        // Reservas já notificadas (histórico de dequeue)
        Reserva::create(['livro_id' => 1,  'usuario_id' => 24, 'posicao_fila' => 0, 'status' => 'notificado']);
        Reserva::create(['livro_id' => 1,  'usuario_id' => 25, 'posicao_fila' => 0, 'status' => 'notificado']);
        Reserva::create(['livro_id' => 16, 'usuario_id' => 26, 'posicao_fila' => 0, 'status' => 'notificado']);
        Reserva::create(['livro_id' => 18, 'usuario_id' => 27, 'posicao_fila' => 0, 'status' => 'notificado']);
        Reserva::create(['livro_id' => 29, 'usuario_id' => 30, 'posicao_fila' => 0, 'status' => 'notificado']);
        Reserva::create(['livro_id' => 29, 'usuario_id' => 31, 'posicao_fila' => 0, 'status' => 'notificado']);

        // Reservas canceladas
        Reserva::create(['livro_id' => 7,  'usuario_id' => 21, 'posicao_fila' => 0, 'status' => 'cancelado']);
        Reserva::create(['livro_id' => 18, 'usuario_id' => 32, 'posicao_fila' => 0, 'status' => 'cancelado']);
    }
}
