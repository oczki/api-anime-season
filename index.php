<?php

date_default_timezone_set('Europe/Warsaw');

function getCurrentSeasonData(): array {
  $now = new DateTime();
  $month = (int)$now->format('n');
  $year = (int)$now->format('Y');

  if ($month >= 1 && $month <= 3) {
    $season = 'winter';
    $startDate = "$year-01-01";
  } elseif ($month >= 4 && $month <= 6) {
    $season = 'spring';
    $startDate = "$year-04-01";
  } elseif ($month >= 7 && $month <= 9) {
    $season = 'summer';
    $startDate = "$year-07-01";
  } else {
    $season = 'fall';
    $startDate = "$year-10-01";
  }

  $daysPassed = (new DateTime($startDate))->diff($now)->days;
  $currentWeek = (int)floor($daysPassed / 7) + 1;

  return [
    'season' => $season,
    'currentWeek' => $currentWeek
  ];
}

function generateResponse(): string {
  $data = getCurrentSeasonData();
  $week = $data['currentWeek'];

  $response = [
    'season' => $data['season'],
    'ep' => [
      'oneCour' => $week,
      'twoCour' => $week + 13,
      'threeCour' => $week + 26,
      'fourCour' => $week + 39
    ]
  ];

  return json_encode(
    $response,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR
  );
}

function sendJsonResponse(): never {
  http_response_code(200);
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json; charset=utf-8');
  echo generateResponse();
  exit;
}

sendJsonResponse();
