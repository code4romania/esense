<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Linii de limbaj de validare
    |--------------------------------------------------------------------------
    |
    | Următoarele linii de limbă conțin mesajele de eroare implicite utilizate de
    | clasa validatorului. Unele dintre aceste reguli au astfel de versiuni multiple
    | precum regulile de mărime. Simțiți-vă liber să modificați fiecare dintre aceste mesaje.
    |
    */

    "accepted"         => "Atributul :attribute trebuie sa fie acceptat.",
    "active_url"       => "Atributul :attribute nu este un URL valid.",
    "after"            => "Atributul :attribute trebuie sa fie o data dupa data de :date.",
    'after_or_equal' => 'Atributul :attribute trebuie să fie o dată după sau egală cu :date.',
    "alpha"            => "Atributul :attribute poate sa contina doar litere.",
    "alpha_dash"       => "Atributul :attribute poate sa contina doar litere, numere, si liniute.",
    "alpha_num"        => "Atributul :attribute poate sa contina doar litere si numere.",
    "array"            => "Atributul :attribute trebuie sa fie de tip matrice.",
    "before"           => "Atributul :attribute trebuie sa fie o data inainte de data de :date.",
    'before_or_equal' => 'Atributul :attribute trebuie să fie o dată anterioară sau egală cu :date.',
    "between"          => [
        "numeric" => "Atributul :attribute trebuie sa fie intre :min - :max.",
        "file"    => "Atributul :attribute trebuie sa fie intre :min - :max kilobytes.",
        "string"  => "Atributul :attribute trebuie sa fie intre :min - :max caractere.",
        "array"   => "Atributul :attribute trebuie sa aiba intre :min - :max elemente.",
    ],
    'boolean' => 'Câmpul :attribute trebuie să fie adevărat sau fals.',
    'confirmed' => 'Confirmarea :attribute nu se potrivește.',
    'date' => ':attribute nu este o dată validă.',
    'date_equals' => ':attribute trebuie să fie o dată egală cu: data.',
    'date_format' => ':attribute nu se potrivește cu formatul: format.',
    'different' => ':attribute și :other trebuie să fie diferite.',
    'digits' => ':attribute trebuie să fie: cifre cifre.',
    'digits_between' => ':attribute trebuie să fie între: min și: max cifre.',
    'dimensions' => ':attribute are dimensiuni nevalide ale imaginii.',
    'distinct' => 'Câmpul :attribute are o valoare duplicat.',
    'email' => ':attribute trebuie să fie o adresă de e-mail validă.',
    'ends_with' => ':attribute trebuie să se încheie cu unul dintre următoarele:: valori.',
    'exists' => ':attribute selectat nu este valid.',
    'file' => ':attribute trebuie să fie un fișier.',
    'filled' => 'Câmpul :attribute trebuie să aibă o valoare.',
    'gt' => [
        'numeric' => ':attribute trebuie să fie mai mare decât :value.',
        'file' => ':attribute trebuie să fie mai mare decât :value kilobyte.',
        'string' => ':attribute trebuie să fie mai mare decât :value caractere.',
        'array' => ':attribute trebuie să aibă mai mult de :value elemente.',
    ],
    'gte' => [
        'numeric' => ':attribute trebuie să fie mai mare sau egal cu: valoare.',
        'file' => ':attribute trebuie să fie mai mare sau egal cu: valoare kilobyte.',
        'string' => ':attribute trebuie să fie mai mare sau egal cu: caractere de valoare.',
        'array' => ':attribute trebuie să aibă: elemente de valoare sau mai multe.',
    ],
    'image' => ':attribute trebuie să fie o imagine.',
    'in' => ':attribute selectat nu este valid.',
    'in_array' => 'Câmpul :attribute nu există în: altele.',
    'integer' => ':attribute trebuie să fie un număr întreg.',
    'ip' => ':attribute trebuie să fie o adresă IP validă.',
    'ipv4' => ':attribute trebuie să fie o adresă IPv4 validă.',
    'ipv6' => ':attribute trebuie să fie o adresă IPv6 validă.',
    'json' => ':attribute trebuie să fie un șir JSON valid.',
    'lt' => [
        'numeric' => ':attribute trebuie să fie mai mic decât: value.',
        'file' => ':attribute trebuie să fie mai mic de: valoare kilobyte.',
        'string' => ':attribute trebuie să fie mai mic de: caractere valoare.',
        'array' => ':attribute trebuie să aibă mai puțin de: elemente de valoare.',
    ],
    'lte' => [
        'numeric' => ':attribute trebuie să fie mai mic sau egal cu :value.',
        'file' => ':attribute trebuie să fie mai mic sau egal :value kilobyte.',
        'string' => ':attribute trebuie să fie mai mic sau egal :value caractere.',
        'array' => ':attribute nu trebuie să aibă mai mult de :value elemente.',
    ],
    'max'              => [
        "numeric" => "Atributul :attribute nu poate fi mai mare de :max.",
        "file"    => "Atributul :attribute nu poate fi mai mare de :max kilobytes.",
        "string"  => "Atributul :attribute nu poate fi mai mare de :max caractere.",
        "array"   => "Atributul :attribute nu poate avea mai mult de :max elemente.",
    ],
    'mimes'            => "Atributul :attribute trebuie sa fie un fisier de tipul: :values.",
    'mimetypes' => ':attribute trebuie să fie un fișier de tip: :value.',
    'min'              => [
        "numeric" => "Atributul :attribute trebuie sa aiba cel putin :min caractere",
        "file"    => "Atributul :attribute trebuie sa aiba cel putin :min kilobytes.",
        "string"  => "Atributul :attribute trebuie sa aiba cel putin :min caractere.",
        "array"   => "Atributul :attribute trebuie sa aiba cel putin :min elemente.",
    ],
    "not_in"           => "Atributul selectat :attribute este invalid.",
    'not_regex' => 'Formatul :attribute este nevalid.',
    "numeric"          => "Atributul :attribute trebuie sa fie un numar.",
    'present' => 'Câmpul :attribute trebuie să fie prezent.',
    "regex"            => "Formatul atributului :attribute este invalid.",
    "required"         => "Campul atributului :attribute este necesar.",
    "required_if"      => "Campul atributului :attribute este necesar cand atributul :other are valoarea :value.",
    'required_unless' => 'Câmpul :attribute este obligatoriu, cu excepția cazului în care :other este în :values.',
    "required_with"    => "Campul atributului :attribute este necesar cand valorea :values este prezenta.",
    'required_with_all' => 'Câmpul :attribute este necesar atunci când: valori sunt prezente.',
    "required_without" => "Campul atributului :attribute este necesar cand valoarea :values nu este prezenta.",
    'required_without_all' => 'Câmpul :attribute este obligatoriu atunci când niciuna dintre :values nu este prezentă.',
    "same"             => "Atributele :attribute si :other trebuie sa corespunda.",
    "size"             => [
        "numeric" => "Atributul :attribute trebuie sa aiba dimensiunea :size.",
        "file"    => "Atributul :attribute trebuie sa aiba dimensiunea :size kilobytes.",
        "string"  => "Atributul :attribute trebuie sa aiba :size caractere.",
        "array"   => "Atributul :attribute trebuie sa contina :size elemente.",
    ],
    'starts_with' => ':attribute  trebuie să înceapă cu unul dintre următoarele: :values.',
    'string' => ':attribute  trebuie să fie un șir.',
    'timezone' => ':attribute  trebuie să fie o zonă validă.',
    'unique' => ':attribute  a fost deja luat.',
    'uploaded' => ':attribute  a eșuat la încărcare.',
    'url' => 'Formatul :attribute  este nevalid.',
    'uuid' => ':attribute  trebuie să fie un UUID valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'mesaj-personalizat',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
