function insertRow(email, gallonsPurchased, fueltype, dateOfPurchase, numTrucksUsed, paymentType, totalBill, expectedProfits, status) {
    const mysql = require('mysql2/promise');
    const pool = mysql.createPool({
        host: 'gasco-server.mysql.database.azure.com',
        user: 'isaac',
        password: 'team53server',
        database: 'gasco',
        waitForConnections: true,
        connectionLimit: 10,
        queueLimit: 0,
    });
    pool.execute(`INSERT INTO FuelQuote (email, gallonsPurchased, fueltype, dateOfPurchase, numTrucksUsed, paymentType, totalBill, expectedProfits, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)`, [email, gallonsPurchased, fueltype, dateOfPurchase, numTrucksUsed, paymentType, totalBill, expectedProfits, status])
    .then(result => {
      console.log(result);
    })
    .catch(err => {
      console.error(err);
    });
}

function goHome() {
    window.location.href = "index.php";
}

function confirmOrder(email, gallonsPurchased, fueltype, dateOfPurchase, numTrucksUsed, paymentType, totalBill, expectedProfits, status) {
    insertRow(email, gallonsPurchased, fueltype, dateOfPurchase, numTrucksUsed, paymentType, totalBill, expectedProfits, status);
    window.location.href = "orderConfirmation.php";
}