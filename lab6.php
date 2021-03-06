<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Lab No. 6 - Temp. Converter</title>
</head>
<body>

<?php
$originalUnit = '--Select--';
$conversionUnit = '--Select--';

function convertTemp($temp, $unit1, $unit2)
{
    // conversion formulas
    // Celsius to Fahrenheit = T(°C) × 9/5 + 32
    // Celsius to Kelvin = T(°C) + 273.15
    // Fahrenheit to Celsius = (T(°F) - 32) × 5/9
    // Fahrenheit to Kelvin = (T(°F) + 459.67)× 5/9
    // Kelvin to Fahrenheit = T(K) × 9/5 - 459.67
    // Kelvin to Celsius = T(K) - 273.15

    if ($unit1 == $unit2) {
        return $temp;
    }
    elseif(($unit1=='celsius') && ($unit2=='farenheit')){
        $newtemp = $temp * (9/5) + 32;
        return $newtemp;
    }elseif(($unit1=='celsius') && ($unit2=='kelvin')){
        $newtemp = $temp + 273.15;
        return $newtemp;
    }elseif(($unit1=='farenheit') && ($unit2=='celsius')){
        $newtemp = ($temp -32) * (5/9);
        return $newtemp;
    }elseif(($unit1=='farenheit') && ($unit2=='kelvin')){
        $newtemp = ($temp + 459.67) * (5/9);
        return $newtemp;
    }elseif(($unit1=='kelvin') && ($unit2=='farenheit')){
        $newtemp = $temp * (9/5) - 459.67;
        return $newtemp;
    }elseif(($unit1=='kelvin') && ($unit2=='celsius')){
        $newtemp = $temp - 273.15;
        return $newtemp;
    }
} // end function

// Logic to check for POST and grab data from $_POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $originalTemperature = $_POST['originaltemp'];
    $originalUnit = $_POST['originalunit'];
    $conversionUnit = $_POST['conversionunit'];
    if ($originalUnit != '--Select--' && $conversionUnit !='--Select--') {
        $convertedTemp = convertTemp($originalTemperature, $originalUnit, $conversionUnit);
    } else {
        echo '<p id="red">Please Select a Unit.</p>';
    }
} 
?>
<!-- Form starts here -->
<h1>Temperature Converter</h1>
<h4>CTEC 127 - PHP with SQL 1</h4>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <div class="group">
        <label for="temp">Temperature</label>
        <input type="text" value="<?php if (isset($_POST['originaltemp'])) {
    echo $_POST['originaltemp'];} ?>" name="originaltemp" size="14" maxlength="7" id="temp">

        <select name="originalunit">
            <option value="--Select--" <?php if ($originalUnit=='--Select--') echo 'selected="selected"'; ?> >--Select--</option>
            <option value="celsius" <?php if ($originalUnit=='celsius') echo 'selected="selected"'; ?> >Celsius</option>
            <option value="farenheit" <?php if ($originalUnit=='farenheit') echo 'selected="selected"'; ?> >Farenheit</option>
            <option value="kelvin" <?php if ($originalUnit=='kelvin') echo 'selected="selected"'; ?> >Kelvin</option>
        </select>
    </div>

    <div class="group">
        <label for="convertedtemp">Converted Temperature</label>
        <input type="text" class="box" value="<?php if (isset($convertedTemp)) {
    echo $convertedTemp;} else {echo " ";}?>"
        name="convertedtemp" size="14" maxlength="7" id="convertedtemp" readonly>

        <select name="conversionunit">
            <option value="--Select--" <?php if($conversionUnit=='--Select--') echo 'selected="selected"'; ?>>--Select--</option>
            <option value="celsius" <?php if($conversionUnit=='celsius') echo 'selected="selected"'; ?>>Celsius</option>
            <option value="farenheit" <?php if($conversionUnit=='farenheit') echo 'selected="selected"'; ?>>Farenheit</option>
            <option value="kelvin" <?php if($conversionUnit=='kelvin') echo 'selected="selected"'; ?>>Kelvin</option>
        </select>
    </div>
    <input type="submit" value="Convert"/>
</form>
</body>
</html>