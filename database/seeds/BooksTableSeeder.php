<?php

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Book;

class BooksTableSeeder extends Seeder
{
  private $genres = [
    'biography', 'classic', 'dystopia', 'essay', 'fable', 'fairy tale',
    'fantasy', 'folktale', 'historical', 'horror', 'humor', 'legend', 'memoir',
    'mystery', 'mythology', 'romance', 'science fiction', 'thriller',
    'westerns',
  ];

  private $words = [
    'pagoda', 'skate', 'duplexer', 'objective', 'carnation', 'bath', 'wetsuit',
    'robe', 'bell', 'eyeball', 'orangutan', 'mixer', 'side', 'fly', 'caboose',
    'contrary', 'gear', 'mailbox', 'sneakers', 'outrigger', 'arrival',
    'confusion', 'penicillin', 'clarinet', 'biology', 'australia', 'oak',
  ];

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('books')->insert([
      'title' => Arr::random($this->words),
      'author' => Arr::random($this->words),
      'synopsis' => implode(' ', Arr::random($this->words, 10)),
      'genre' => Arr::random($this->genres),
    ]);
  }
}
