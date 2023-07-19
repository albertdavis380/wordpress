
        /**
          * 1. Constructor Pattern
          * 1. Constructor Pattern
          * 1. Constructor Pattern
        */

        //
        -------------------------------------
        //  a) Traditional "function" based syntax
         
        function Person(name,age) {
                this.name = name;
                this.age = age;
                this.getDetails = function () {
                    console.log(`${this.name} is ${this.age} years old!`);
            
            }
        }
         
        //  b) ES6 "class" syntax
         
        class Person {
            constructor(name, age) {
                this.name = name;
                this.age = age;
                this.getDetails = function () {
                    console.log(`${this.name} is ${this.age} years old!`);
                };
            }
        }
         
        //Creating new instance of Person
        const personOne = new Person('John',20);
        personOne.getDetails(); // Output - “John is 20years old!”


        /**
          * 2. Factory Pattern
          * 2. Factory Pattern
          * 2. Factory Pattern
        */


        function shapeFactory(){
            this.createShape = function (shapeType) {
         
                var shape;
                switch(shapeType){
                    case "rectangle":
                        shape = new Rectangle();
                        break;
                    case "square":
                        shape = new Square();
                        break;
                    case "circle":
                        shape = new Circle();
                        break;    
                    default:
                        shape = new Rectangle();
                        break;
                }
                return shape;
            }
        }
         
        // Constructor for defining new Rectangle
        var Rectangle = function () {
            this.draw = function () {
                console.log('This is a Rectangle');
            }
        };
         
        // Constructor for defining new Square
        var Square = function () {
            this.draw = function () {
                console.log('This is a Square');
            }
        };
         
        // Constructor for defining new Circle
        var Circle= function () {
            this.draw = function () {
                console.log('This is a Circle');
            }
        };
         
        var factory = new shapeFactory();
        //Creating instance of factory that makes rectangle,square,circle respectively
        var rectangle = factory.createShape('rectangle');
        var square = factory.createShape('square');
        var circle= factory.createShape('circle');
         
        rectangle.draw();
        square.draw();
        circle.draw();
 
        /*
          OUTPUT
          
          This is a Rectangle
          This is a Square
          This is a Circle
         
        */

        /**
          * 3. Prototype Pattern
          * 3. Prototype Pattern
          * 3. Prototype Pattern
        */



        // Prototype Class
        const car = {
            noOfWheels: 4,
            start() {
              return 'started';
            },
            stop() {
              return 'stopped';
            },
          };
         
         
        //using Object.create to create clones - as recommended by ES5 standard
          const myCar = Object.create(car, { owner: { value: 'John' } });
          
          console.log(myCar.__proto__ === car); // true








          // 4. Singleton Pattern

            var Singleton = (function () {
                var instance;
             
                function createDBInstance() {
                    var object = new Object("I am the DataBase instance");
                    return object;
                }
             
                return {
                    getDBInstance: function () {
                        if (!instance) {
                            instance = createDBInstance();
                        }
                        return instance;
                    }
                };
            })();
             
            function run() {
             
                var instance1 = Singleton.getDBInstance();
                var instance2 = Singleton.getDBInstance();
             
                console.log("Same instance? " + (instance1 === instance2));  
            }
             
            run(); // OUTPUT = "Same instance? true"



           /**
              * Structural Design Patterns
              * Structural Design Patterns
              * Structural Design Patterns
           */







             /** @ 1. Adapter Pattern */

            function TicketPrice() {
                this.request = function(start, end, overweightLuggage) {
                    // price calculation code...
                    return "$150.34";
                }
            }
             
            // new interface
            function NewTicketPrice() {
                this.login = function(credentials) { /* process credentials */ };
                this.setStart = function(start) { /* set start point */ };
                this.setDestination = function(destination) { /* set destination */ };
                this.calculate = function(overweightLuggage) { 
                    //price calculation code...
                    return "$120.20"; 
                };
            }
             
            // adapter interface
            function TicketAdapter(credentials) {
                var pricing = new NewTicketPrice();
              
                pricing.login(credentials);
              
                return {
                    request: function(start, end, overweightLuggage) {
                        pricing.setStart(start);
                        pricing.setDestination(end);
                        return pricing.calculate(overweightLuggage);
                    }
                };
            }
             
            var pricing = new TicketPrice();
            var credentials = { token: "30a8-6ee1" };
            var adapter = new TicketAdapter(credentials);
             
            // original ticket pricing and interface
            var price = pricing.request("Bern", "London", 20);
            console.log("Old price: " + price);
             
            // new ticket pricing with adapted interface
            price = adapter.request("Bern", "London", 20);
            console.log("New price: " + price);







             /** @ 2. Composite Pattern  */

            function File(name) {
                this.name = name;
            }
             
            File.prototype.display = function () {
                console.log(this.name);
            }
             
            function Directory(name) {
                this.name = name;
                this.files = [];
            }
             
            Directory.prototype.add = function (file) {
                this.files.push(file);
            }
             
            Directory.prototype.remove = function (file) {
                for (let i = 0, length = this.files.length; i < length; i++) {
                    if (this.files[i] === file) {
                        this.files.splice(i, 1);
                        return true;
                    }
                }
                
                return false;
            }
             
            Directory.prototype.getFileName = function (index) {
                return this.files[index].name;
            }
             
            Directory.prototype.display = function() {
                console.log(this.name);
                for (let i = 0, length = this.files.length; i < length; i++) {
                    console.log("   ", this.getFileName(i));
                }
            }
             
            directoryOne = new Directory('Directory One');
            directoryTwo = new Directory('Directory Two');
            directoryThree = new Directory('Directory Three');
             
            fileOne = new File('File One');
            fileTwo = new File('File Two');
            fileThree = new File('File Three');
             
            directoryOne.add(fileOne);
            directoryOne.add(fileTwo);
             
            directoryTwo.add(fileOne);
             
            directoryThree.add(fileOne);
            directoryThree.add(fileTwo);
            directoryThree.add(fileThree);
             
            directoryOne.display();
            directoryTwo.display();
            directoryThree.display();
             
            /*
            Directory One
                File One
                File Two
            Directory Two
                File One
            Directory Three
                File One
                File Two
                File Three
            */






                /** @ 3. Module Pattern  */

                (function() {
             
                // declare private variables and/or functions
             
                    return {
                    // declare public variables and/or functions
                    }
                 
                })();

                function AnimalContainter () {
                //private variables and/or functions
                const container = [];
                
                function addAnimal (name) {
                container.push(name);
                }
                
                function getAllAnimals() {
                return container;
                }
                
                function removeAnimal(name) {
                const index = container.indexOf(name);
                if(index < 1) {
                throw new Error('Animal not found in container');
                }
                container.splice(index, 1)
                }
                
                return {
                public variables and/or functions
                add: addAnimal,
                get: getAllAnimals,
                remove: removeAnimal
                }
                }
                
                const container = AnimalContainter();
                container.add('Hen');
                container.add('Goat');
                container.add('Sheep');
                
                console.log(container.get()) //Array(3) ["Hen", "Goat", "Sheep"]
                container.remove('Sheep')
                console.log(container.get()); //Array(2) ["Hen", "Goat"]






                 /** @ 4. Decorator Pattern  */

                // A vehicle constructor
                function Vehicle( vehicleType ){
                 
                    // some sane defaults
                    this.vehicleType = vehicleType || "car";
                    this.model = "default";
                    this.license = "00000-000";
                 
                }
                 
                // Test instance for a basic vehicle
                var testInstance = new Vehicle( "car" );
                console.log( testInstance );
                 
                // Outputs:
                // vehicle: car, model:default, license: 00000-000
                 
                // Lets create a new instance of vehicle, to be decorated
                var truck = new Vehicle( "truck" );
                 
                // New functionality we're decorating vehicle with
                truck.setModel = function( modelName ){
                    this.model = modelName;
                };
                 
                truck.setColor = function( color ){
                    this.color = color;
                };
                 
                // Test the value setters and value assignment works correctly
                truck.setModel( "CAT" );
                truck.setColor( "blue" );
                 
                console.log( truck );
                 
                // Outputs:
                // vehicle:truck, model:CAT, color: blue
                 
                // Demonstrate "vehicle" is still unaltered
                var secondInstance = new Vehicle( "car" );
                console.log( secondInstance );
                 
                // Outputs:
                // vehicle: car, model:default, license: 00000-000






                /** @ 5. Facade Pattern  */


                 var Mortgage = function(name) {
                    this.name = name;
                 }
                 
                Mortgage.prototype = {
                 
                    applyFor: function(amount) {
                        // access multiple subsystems...
                        var result = "approved";
                        if (!new Bank().verify(this.name, amount)) {
                            result = "denied";
                        } else if (!new Credit().get(this.name)) {
                            result = "denied";
                        } else if (!new Background().check(this.name)) {
                            result = "denied";
                        }
                        return this.name + " has been " + result +
                               " for a " + amount + " mortgage";
                    }
                }
                 
                var Bank = function() {
                    this.verify = function(name, amount) {
                        // complex logic ...
                        return true;
                    }
                }
                 
                var Credit = function() {
                    this.get = function(name) {
                        // complex logic ...
                        return true;
                    }
                }
                 
                var Background = function() {
                    this.check = function(name) {
                        // complex logic ...
                        return true;
                    }
                }
                 
                function run() {
                    var mortgage = new Mortgage("Joan Templeton");
                    var result = mortgage.applyFor("$100,000");
                 
                    alert(result);
                }






                 /** @ 6. Proxy Pattern  */

                        /*  External API*/
                var FlightListAPI = function() {
                //creation
                };
                 
                FlightListAPI.prototype = {
                getFlight: function() {
                    // get master list of flights
                    console.log('Generating flight List');
                },
                 
                searchFlight: function(flightDetails) {
                    // search through the flight list based on criteria
                    console.log('Searching for flight');
                },
                 
                addFlight: function(flightData) {
                    // add a new flight to the database
                    console.log('Adding new flight to DB');
                }
                };
                 
                // creating the proxy
                var FlightListProxy = function() {
                    // getting a reference to the original object
                this.flightList = new FlightListAPI();
                };
                 
                FlightListProxy.prototype = {
                getFlight: function() {
                    return this.flightList.getFlight();
                },
                 
                searchFlight: function(flightDetails) {
                    return this.flightList.searchFlight(flightDetails);
                },
                 
                addFlight: function(flightData) {
                    return this.flightList.addFlight(flightData);
                },
                 
                };
                 
                console.log("----------With Proxy----------")
                const proxy = new FlightListProxy()
                console.log(proxy.getFlight());
                /*
                 
                OUTPUT
                 
                ----------With Proxy----------
                Generating flight List
                 
                 
                */
                

                /**
                  * @Behavioural Design Pattern
                  * @Behavioural Design Pattern
                  * @Behavioural Design Pattern
                */

                /** @ 1. Chain of Responsibility Pattern  */

                var Request = function(amount) {
                    this.amount = amount;
                    console.log("Request Amount:" +this.amount);
                }
                 
                Request.prototype = {
                    get: function(bill) {
                        var count = Math.floor(this.amount / bill);
                        this.amount -= count * bill;
                        console.log("Dispense " + count + " $" + bill + " bills");
                        return this;
                    }
                }
                 
                function run() {
                    var request = new Request(378); //Requesting amount
                    request.get(100).get(50).get(20).get(10).get(5).get(1);
                }

                



                /** @ 2. Command Pattern   */

                var calculator = {
                    add: function(x, y) {
                        return x + y;
                    },
                    subtract: function(x, y) {
                        return x - y;
                    },
                    divide: function(x,y){
                        return x/y;
                    },
                    multiply: function (x,y){
                        return x*y;
                    }
                }
                var manager = {
                    execute: function(name, args) {
                        if (name in calculator) {
                            return calculator[name].apply(calculator, [].slice.call(arguments, 1));
                        }
                        return false;
                    }
                }
                console.log(manager.execute("add", 5, 2)); // prints 7
                console.log(manager.execute("multiply", 2, 4)); // prints 8






                /** @ 3. Observer Pattern  */

                function Click() {
                    this.observers = [];  // observers
                }
                 
                Click.prototype = {
                 
                    subscribe: function(fn) {
                        this.observers.push(fn);
                    },
                 
                    unsubscribe: function(fn) {
                        this.observers = this.observers.filter(
                            function(item) {
                                if (item !== fn) {
                                    return item;
                                }
                            }
                        );
                    },
                 
                    fire: function(o, thisObj) {
                        var scope = thisObj;
                        this.observers.forEach(function(item) {
                            item.call(scope, o);
                        });
                    }
                }
                 
                function run() {
                 
                    var clickHandler = function(item) { 
                        console.log("Fired:" +item);
                    };
                 
                    var click = new Click();
                 
                    click.subscribe(clickHandler);
                    click.fire('event #1');
                    click.unsubscribe(clickHandler);
                    click.fire('event #2');
                    click.subscribe(clickHandler);
                    click.fire('event #3');
                 
                }
                 
                /* OUTPUT:
                 
                Fired:event #1
                Fired:event #3
                 
                */





                 /** @ 4. Iterator Pattern   */ 

                const items = [1,"hello",false,99.8];
                 
                function Iterator(items){
                  this.items = items;
                  this.index = 0; // to start from beginning position of array
                }
                 
                Iterator.prototype = {
                  // returns true if a next element is available
                  hasNext: function(){
                    return this.index < this.items.length;
                  },
                  //returns next element
                  next: function(){
                    return this.items[this.index++]
                  }
                }
                 
                //Instantiate object for Iterator
                const iterator =  new Iterator(items);
                while(iterator.hasNext()){
                  console.log(iterator.next());
                }
                /*
                OUTPUT
                 
                1
                hello
                false
                99.8
                 
                */ 




                /** @ 5. Template Pattern   */ 

                // implement template method
         
                var datastore = {
                    process: function() {
                        this.connect();
                        this.select();
                        this.disconnect();
                        return true;
                    }
                };
                 
                function inherit(proto) {
                    var F = function() { };
                    F.prototype = proto;
                    return new F();
                }
                 
                 
                function run() {
                    var mySql = inherit(datastore);
                 
                    // implement template steps
                 
                    mySql.connect = function() {
                        console.log("MySQL: connect step");
                    };
                 
                    mySql.select = function() {
                        console.log("MySQL: select step");
                    };
                 
                    mySql.disconnect = function() {
                        console.log("MySQL: disconnect step");
                    };
                 
                    mySql.process();
                 
                }
                 
                run();
                /* 
                 
                MySQL: connect step
                MySQL: select step
                MySQL: disconnect step
                 
                */




                /** @ 6. Strategy Pattern   */  

                //Strategy1 
                function FedEx(){
                  this.calculate = package => {
                    //calculations  happen here..
                    return 2.99
                  }
                }
                 
                //Strategy2
                function UPS(){
                  this.calculate = package => {
                    //calculations  happen here..
                    return 1.59
                  }
                }
                 
                //Strategy3
                function USPS(){
                  this.calculate = package => {
                    //calculations  happen here..
                    return 4.5
                  }
                }
                 
                // encapsulation
                function Shipping(){
                  this.company = "";
                  this.setStrategy = (company) => {
                    this.company=company;
                  }
                  this.calculate = (package) =>{
                    return this.company.calculate(package);
                  }
                }
                 
                //usage
                const fedex = new FedEx();
                const ups = new UPS();
                const usps = new USPS();
                 
                const package = { from: 'Alabama',to:'Georgia',weight:1.5};
                 
                const shipping = new Shipping();
                shipping.setStrategy(fedex);
                console.log("Fedex:" +shipping.calculate(package)); // OUTPUT => "Fedex:2.99"