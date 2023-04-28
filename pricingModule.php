<?php

session_start();

require_once __DIR__ . '/../src/client.php';
//require_once __DIR__ . '/../components/nav-bar.php';

ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);
//include_once 'server/loginSession.php'; // Maintains session information

require_once __DIR__ . '/db_connection.php';

if (isset($_SESSION['client'])) {
  $client = $_SESSION['client'];

  // Constants
  $currentPricePerGallon = 1.50; // Current price per gallon
  $locationFactorTexas = 0.02; // Location factor for Texas
  $locationFactorOutOfState = 0.04; // Location factor for out of state
  $rateHistoryFactorWithHistory = 0.01; // Rate history factor with history
  $rateHistoryFactorWithoutHistory = 0; // Rate history factor without history
  $gallonsRequestedFactorMoreThan1000 = 0.02; // Gallons requested factor for more than 1000 gallons
  $gallonsRequestedFactorLessThan1000 = 0.03; // Gallons requested factor for less than 1000 gallons
  $companyProfitFactor = 0.10; // Company profit factor

  // Get input data from POST request
  $data = json_decode(file_get_contents('php://input'), true);
  $gallonsRequested = $data['gallonsRequested'];
  $state = $client->getCompanyState();
  $hasRateHistory = false; // Assume no rate history initially
  $email = $client->getEmail();

  // Check if client has rate history 
  $stmt = $conn->prepare("SELECT COUNT(*) FROM fuelquote WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $count = $result->fetch_row()[0]; // Fetch the count value

  if ($count > 0)
  {
      $hasRateHistory = true;
  }

  // Calculate margin
  $locationFactor = $state === 'Texas' ? $locationFactorTexas : $locationFactorOutOfState;
  $rateHistoryFactor = $hasRateHistory ? $rateHistoryFactorWithHistory : $rateHistoryFactorWithoutHistory;
  $gallonsRequestedFactor = $gallonsRequested > 1000 ? $gallonsRequestedFactorMoreThan1000 : $gallonsRequestedFactorLessThan1000;
  $margin = ($locationFactor - $rateHistoryFactor + $gallonsRequestedFactor + $companyProfitFactor) * $currentPricePerGallon;

  // Calculate suggested price per gallon and total amount due
  $suggestedPricePerGallon = $currentPricePerGallon + $margin;
  $totalAmountDue = $gallonsRequested * $suggestedPricePerGallon;

  // Prepare response data
  $response = array(
      'suggestedPrice' => number_format($suggestedPricePerGallon, 3),
      'totalAmount' => number_format($totalAmountDue, 2)
  );

  // Send response as JSON
  header('Content-Type: application/json');
  echo json_encode($response);
}
else {
  header('HTTP/1.0 401 Unauthorized');
  echo "Unauthorized";
}
?>