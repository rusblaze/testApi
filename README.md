 # Test API in scope of test task from propertyfinder.ae
 
 ## Task
 
 You are given a stack of boarding cards for various transportations that will take you from a point A to point B via several stops on the way. All of the boarding cards are out of order and you don't know where your journey starts, nor where it ends. Each boarding card contains information about seat assignment, and means of transportation (such as flight number, bus number etc).
 
 Write an API that lets you sort this kind of list and present back a description of how to complete your journey.
 
 For instance the API should be able to take an unordered set of boarding cards, provided in a format defined by you, and produce this list:
 
 * Take train 78A from Madrid to Barcelona. Sit in seat 45B.
 * Take the airport bus from Barcelona to Gerona Airport. No seat assignment.
 * From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A.
 Baggage drop at ticket counter 344.
 * From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B.
 Baggage will we automatically transferred from your last leg.
 * You have arrived at your final destination.
 
 The list should be defined in a format that's compatible with the input format.
 
 The API is to be an internal PHP API so it will only communicate with other parts of a PHP application, not server to server, nor server to client.
 
 Use PHP-doc to document the input and output your API accepts / returns.
 
 ## Setup
 ### Composer + Git
 Check out latest version via
 
```bash
  $ git checkout git@github.com:rusblaze/testApi.git INSTALLATION_DIR 
  $ cd INSTALLATION_DIR
  $ composer install
```

 ## Code execution
 As it mentioned in task, entire project is a library.
 So for execution it is required to include project in another PHP application.
 After inclusion you should instantiate the entry point and run `sort` method.
 
 Example:
 ```php
 use TestApi\Domain\Entity\{
    BoardingCardFlight,
    BoardingCardBus
 };
 
 ...
 
 $boardingCards = [
    new BoardingCardAirportBus('Gerona', '332', 'Barcelona', 'Gerona'),
    new BoardingCardTrain('78A', 'Madrid', 'Barcelona', '45B'),
 ];
 $route = $sorter->sort(
     $boardingCards
 );
 ```
 The '$route' will be (printed with `print_r` function)
 ```php
 Array
 (
     [0] => TestApi\Domain\Entity\BoardingCardTrain Object
         (
             [trainNumber:TestApi\Domain\Entity\BoardingCardTrain:private] => 78A
             [seat:TestApi\Domain\Entity\BoardingCardAbstract:private] => 45B
             [startPoint:TestApi\Domain\Entity\BoardingCardAbstract:private] => Madrid
             [endPoint:TestApi\Domain\Entity\BoardingCardAbstract:private] => Barcelona
         )
 
     [1] => TestApi\Domain\Entity\BoardingCardAirportBus Object
         (
             [airport:TestApi\Domain\Entity\BoardingCardAirportBus:private] => Gerona
             [busNumber:TestApi\Domain\Entity\BoardingCardBus:private] => 332
             [seat:TestApi\Domain\Entity\BoardingCardAbstract:private] => 
             [startPoint:TestApi\Domain\Entity\BoardingCardAbstract:private] => Barcelona
             [endPoint:TestApi\Domain\Entity\BoardingCardAbstract:private] => Gerona
         )
 
 )
 ```
 Then just print `$route` array via your template engine or pass it via external API.
 
 ## Exceptions
 API throws exceptions:
 * `TestApi\Application\Exception\BrokenRouteChainException`
 when input is not containing boarding card for any chain in route
 * `TestApi\Application\Exception\InputDuplicatedBoardingCardException`
 when input contains more then one boarding card for either start or end point 
 * `\TypeError`
 when input contains element, which is not an instance of `BoardingCardAbstract` class
 
 ## Tests execution
 In a root dir of a project run
```bash
   $ ./vendor/bin/phpunit
```

## TODO
* Add functionality for building routes with alternatives 
(more then one route from one point to another)