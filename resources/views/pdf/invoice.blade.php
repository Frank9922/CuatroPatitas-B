<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption Certificate</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .certificate-container {
    position: relative;
    width: 800px;
    height: 600px;
    margin: 0 auto;
}

.certificate-background {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
}

.certificate-content {
    position: relative;
    padding: 20px;
    text-align: center;
}

h1 {
    font-size: 36px;
    font-weight: bold;
    margin-bottom: 20px;
}

h2 {
    font-size: 24px;
    font-weight: bold;
}

p {
    font-size: 18px;
    line-height: 1.5;
}

.adopter-name, .pet-name, .adoption-date {
    color: #007bff;
}

.shelter-logo {
    width: 150px;
    height: auto;
    margin-top: 20px;
}

.shelter-name {
    font-size: 16px;
    font-weight: bold;
    margin-top: 10px;
}
</style>
<body>
    <div class="certificate-container">
        <img src="certificate-background.jpg" alt="Certificate Background" class="certificate-background">

        <div class="certificate-content">
            <div class="certificate-header">
                <img src="university-logo.png" alt="University Logo" class="university-logo">
                <h1>Certificate of Adoption</h1>
            </div>

            <div class="certificate-body">
                <p>This certificate is presented to</p>
                <h2 class="adopter-name">John Doe</h2>

                <p>for the adoption of</p>
                <h2 class="pet-name">Max</h2>

                <p>on</p>
                <h2 class="adoption-date">2024-06-11</h2>

                <p>We are grateful for your decision to provide a loving home for Max. We are confident that you and Max will have many happy years together.</p>
            </div>

            <div class="certificate-footer">
                <p class="signature">Issued by:</p>
                <img src="shelter-logo.png" alt="Shelter Logo" class="shelter-logo">
                <p class="shelter-name">Happy Paws Animal Shelter</p>
            </div>
        </div>
    </div>
</body>
</html>