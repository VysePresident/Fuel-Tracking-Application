<?php 

    $currentPricePerGallon = 1.50; // Current price per gallon

    $locationFactorTexas = 0.02; // Location factor for Texas
    $locationFactorOutOfState = 0.04; // Location factor for out of state

    $rateHistoryFactorWithHistory = 0.01; // Rate history factor with history
    $rateHistoryFactorWithoutHistory = 0; // Rate history factor without history

    $gallonsRequestedFactorMoreThan1000 = 0.02; // Gallons requested factor for more than 1000 gallons
    $gallonsRequestedFactorLessThan1000 = 0.03; // Gallons requested factor for less than 1000 gallons
    $companyProfitFactor = 0.10; // Company profit factor

    //$state = $client->getCompanyState();
    $hasRateHistory = false; // Assume no rate history initially
    //$email = $client->getEmail();

    //TESTING TESTING TESTING DUMMY VALUES

    // Check if client has rate history 
    $stmt = $conn->prepare("SELECT COUNT(*) FROM fuelquote WHERE email = ?");
    $stmt->bind_param("s", $email); // TESTING
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
?>