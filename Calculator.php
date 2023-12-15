<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $expression = $_POST["expression"];
    $result = calculateExpression($expression);
    $_SESSION["result"] = $result;
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit();
}

function calculateExpression($expression) {
    $result = @eval("return $expression;");
    return ($result === false) ? "Invalid Expression" : $result;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .calculator {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        text-align: center;
        max-width: 400px;
        width: 100%;
    }

    h2 {
        color: #333;
    }

    form {
        margin-top: 20px;
    }

    label {
        font-size: 18px;
        display: block;
        margin-bottom: 8px;
        color: #333;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #45a049;
    }

    h3 {
        margin-top: 20px;
        color: #333;
    }
    </style>
</head>

<body>
    <div class="calculator">
        <h2>PHP Calculator</h2>
        <form method="post" action="">
            <label for="expression">Enter Expression:</label>
            <input type="text" id="expression" name="expression" required>
            <button type="submit">Calculate</button>
        </form>

        <?php
        if (isset($_SESSION["result"])) {
            echo "<h3>Result: {$_SESSION["result"]}</h3>";
            unset($_SESSION["result"]);
        }
        ?>
    </div>
</body>

</html>