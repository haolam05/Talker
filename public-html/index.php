<?php
    $website = 'http://www.zavrel.net';
?>

<!DOCTYPE html>  
<head>  
    <title>Hello World!</title>
</head>

<body>  
    <h1>Hello World!</h1>
    <a href="<?php echo $website; ?>"><?php echo "ZAVREL CONSULTING: $website"; ?></a>
    <?php
        $trueValue = true;
        $falseValue = false;
    ?>
    <p><?php echo "This is the content of trueValue $trueValue"; ?></p>
    <p><?php echo "This is the content of falseValue $falseValue"; ?></p>
    <p>
        <?php
            $countries = array('Finland', 'France', 'Spain');
            print_r($countries);
            $countries[] = 'Italy';
            print_r($countries);
            echo $countries[1];
        ?>
    </p>

    <p>
        <?php
            echo $countries[1];
        ?>
    </p>

    <p>
        <?php
            echo count($countries);
        ?>
    </p>

    <p>
        <?php
            $age = array('John' => 35, 'Paul' => 24, 'George' => 27);
            print_r($age);
        ?>
    </p>

    <p>
        <?php
            echo $age['Paul'];
        ?>
    </p>

    <script>
        var cars = ['Mercedes', 'Volvo', 'BMW', 'Tesla'];
        for (i in cars) {
            console.log("The current car is " + cars[i]);
        }
    </script>

    <?php
        $cars = ['Mercedes', 'Volvo', 'BMW', 'Tesla'];
        foreach ($cars as $car) {
            echo "The current car is $car<br>";
        }
    ?>

    <p>
        <?php
            class carBluePrint {
                // Here goes the properties and methods    

                // constructor
                public function __construct($newColor, $newMake) {  // __ : magic method, __destruct(): called when object is destructed
                    $this->color = $newColor;
                    $this->make = $newMake;
                }
                
                // setter method
                public function setColor($newColor) {
                    $this->color = $newColor;
                }

                // getter method
                public function getColor() {
                    return "<br>New color is: $this->color<br>";
                }
            }

            $firstRealCar = new carBluePrint('green', 'Volva');

            // The var_dump() function is used to dump information about a variable. This function displays structured information such as type and value of the given variable. Arrays and objects are explored recursively with values indented to show structure.
            var_dump($firstRealCar);
            echo $firstRealCar->color;          // attribute call
            echo $firstRealCar->getColor();     // function call

            $secondRealCar = new carBluePrint('brown', 'Mercedes');
            var_dump($secondRealCar);
            echo $secondRealCar->getColor();
        ?>
    </p>

    <p>
        <?php
            class sportCarBluePrint extends carBluePrint {
                // constructor
                public function __construct($newColor, $newMake, $newSpoiler) {
                    parent::__construct($newColor, $newMake);                   // parent:: means call the parent maethod of this class, and in this case, it is the constructor method
                    $this->spoiler = $newSpoiler;
                }

                public function activateSpoiler() {
                    return "<br><strong>SPOILER ACTIVE!</strong><br>";
                }
            }

            $firstSportCar = new sportCarBluePrint('magenta', 'Porsche', 'tail');
            $firstSportCar->setColor('PINK');
            var_dump($firstSportCar);
            echo $firstSportCar->activateSpoiler();                             // -> means .
        ?>
    </p>

    <p>
        <?php
            function divideOneByNumber($number) {
                if ($number == 0) {
                    throw new Exception("Division by zero is not allowed.");
                }
                return 1/$number;
            }
            
            try {
                echo "The result of division is: " . divideOneByNumber(9) . "<br>"; 
                echo "The result of division is: " . divideOneByNumber(0); 
            } catch(Exception $error) {
                echo 'Message: ' . $error->getMessage();
            }
        ?>
    </p>
</body>

