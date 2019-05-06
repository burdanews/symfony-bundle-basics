<?php

namespace HBM\Basics\Util\Data;

class Gender extends AbstractData {

  public const M  =  'm';
  public const W  =  'w';
  public const D  =  'd';
  public const T  =  't';

  public static $data = [
    self::M => [
      'text' => 'männlich',
      'short' => 'männlich',
      'aliases' => ['m', 'männlich', 'herr', 'mann', 'sehr geehrter', 'sehr geehrter herr', 'lieber herr'],
      'icon' => 'mars',
      'color' => '#add8e6',
    ],
    self::W => [
      'text' => 'weiblich',
      'short' => 'weiblich',
      'aliases' => ['w', 'weiblich', 'frau', 'sehr geehrte', 'sehr geehrte frau', 'liebe frau'],
      'icon' => 'venus',
      'color' => '#ffc0cb',
    ],
    self::D => [
      'text' => 'divers / nicht-binär / intersexuell',
      'short' => 'divers',
      'aliases' => [
        'd', 'divers', 'neutral', 'neuter',
        'n', 'nonbinary', 'non-binary', 'nicht binär', 'genderless', 'geschlechtslos',
        'i', 'inter', 'intersex', 'intersexuell', 'inter',
        'fluid', 'genderfluid',
      ],
      'icon' => 'genderless',
      'color' => '#cccccc',
    ],
    self::T => [
      'text' => 'trans',
      'short' => 'trans',
      'aliases' => [
        'trans', 'transgender', 'trans-gender', 'transsexuell', 'trans-sexuell',
        'tm',  'transmann', 'trans-mann',
        'tf', 'transfrau', 'trans-frau',
      ],
      'icon' => 'transgender',
      'color' => '#cccccc',
    ],
  ];

}