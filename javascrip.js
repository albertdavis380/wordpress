
/*= is exactly equal
!= is not equal
^= is starts with
$= is ends with
*= is contains
~= is contains word
|= is starts with prefix (i.e., |= "prefix" matches "prefix-...")*/

function Bike(model,color){
   this.model = model,
   this.color = color,
this.getDetails = function(){
     return this.model+' bike is '+this.color;
   }
}
var bikeObj1 = new Bike('BMW','BLACK');
var bikeObj2 = new Bike('BMW','WHITE');
console.log(bikeObj1.getDetails()); //output: BMW bike is BLACK
console.log(bikeObj2.getDetails()); //output: BMW bike is WHITE


function Bike(model,color){
  this.model = model,
  this.color = color
}
Bike.prototype.getDetails = function(){
 return this.model+" bike is "+this.color;
}
var bikeObj1 = new Bike(‘BMW’,’Black’);
console.log(bikeObj1.getDetails());


class Bike{
  constructor(color, model) {
    this.color= color;
    this.model= model;
  }
}


(function () 
{// logic here })
();


var greeting='Welcome to blog';
(function(){
  console.log(greeting); //Output: Welcome to blog
})();


(function(){
var greeting = 'Welcome to blog';
  console.log(greeting); //Output: Welcome to blog
})();
console.log(greeting); //Output:Reference-Error greeting not defined



function User(name){
  var displayName = function(greeting){
   console.log(greeting+' '+name);
  }
return displayName;
}
var myFunc = User('Raj');
myFunc('Welcome '); //Output: Welcome Raj
myFunc('Hello '); //output: Hello Raj




var myModule = (function() {
    'use strict';
 
    var _privateProperty = 'Hello World';
     
    function _privateMethod() {
        console.log(_privateProperty);
    }
     
    return {
        publicMethod: function() {
            _privateMethod();
        }
    };
}());
  
myModule.publicMethod();                    // outputs 'Hello World'   
console.log(myModule._privateProperty);     // is undefined      
protected by the module closure
myModule._privateMethod();                  // is TypeError protected by the module closure


//myMOdule.js file
export default myModule;

//second.js file 
import myModule from `./myModule`;


console.log(Hoist);
var Hoist = ’The variable Has been hoisted’;
//output : undefined//


var Hoist;
console.log(Hoist);
Hoist = ’The variable Has been hoisted’


var add =   function (a){
                 return function(b){
                       return function(c){
                              return a+b+c;
                              }        
                        }
                  }
console.log(add(2)(3)(4)); //output 9
console.log(add(3)(4)(5)); //output 12


const memoizedAdd = () => {
        let cache = {};
        return (value) => {
            if (value in cache) {
                console.log('Fetching from cache');
                return cache[value];
            } else {
                console.log('Calculating result');
                let result = value + 10;
                cache[value] = result;
                return result;
            }
        }
    }
// returned function from memoizedAdd
const newAdd = memoizedAdd();
console.log(newAdd(9)); //output: 19 calculated
console.log(newAdd(9)); //output: 19 cached




var obj={
   num : 2
}
var add = function(num2,num3,num4){
   return this.num + num2 + num3 + num4;
}
var arr=[3,4,5];
//Call method 
console.log(add.call(obj,3,4,5));  //Output : 14
//Apply method
console.log(add.apply(obj,arr));   //Output : 14
//bind Method
var bound = add.bind(obj);
console.log(bound(3,4,5));         //output : 14 





var employee = new Employee('raja');
//override function
//this method going to execute
Employee.prototype.getDetails = function() {
    return this.name.toUpperCase();
}
console.log(employee.getDetails()); //outPut: RAJA
//object and prototype function
function Employee(name) {
    this.name = name;
}
Employee.prototype.getDetails = function() {
    return this.name;
}




index.html
<script src='index.js'>           //default Synchronous
<script async src='index.js'>      //parse as Asynchronously
<script defer src='index.js'>      //parse as deferred




function greeting(name) {
console.log('Hello ' + name);
}
function processUserInput(callback) {
    //var name = prompt('Please enter your name.');
    name = 'raja';
    callback(name);
}
processUserInput(greeting); //output Hello Raja





var promise1 = new Promise(function(resolve, reject) {
    isDbOperationCompleted = false;
    if (isDbOperationCompleted) {
        resolve('Completed');
    } else {
        reject('Not completed');
    }
});
promise1.then(function(result) {
    console.log(result); //Output : Completed
}).catch(function(error) {
    console.log(error); //if isDbOperationCompleted=FALSE                                                  
    //Output : Not Completed
})




async function getUserDetail() {
    try {
        let users = await getUsers();
        return users[0].name;
    } catch (err) {
        return {
            name: 'default user'
        };
    }
}


// The nature of asynchronous code

console.log ('Starting');
let image;

fetch('coffee.jpg').then((response) => {
  console.log('It worked :)')
  return response.blob();
}).then((myBlob) => {
  let objectURL = URL.createObjectURL(myBlob);
  image = document.createElement('img');
  image.src = objectURL;
  document.body.appendChild(image);
}).catch((error) => {
  console.log('There has been a problem with your fetch operation: ' + error.message);
});

console.log ('All done!');


// Array functions

const array1 = [5, 12, 8, 130, 44];

const found = array1.find(element => element > 7);

// 12 


var fruits = ["Banana", "Orange", "Apple", "Mango"];

fruits.copyWithin(2, 0);

// ["Banana", "Orange", "Banana", "Orange"]


var fruits = ["Banana", "Orange", "Apple", "Mango"];

var f = fruits.entries();

for (x of f){ console.log(x) }

 // [0, "Banana"]
 // [1, "Orange"]
 // [2, "Apple"]
 // [3, "Mango"]


var ages = [32, 33, 16, 40];

function checkAdult(age) {
  return age >= 18;
}
 
 ages.every(checkAdult)

// false 


  var ages = [32, 33, 16, 40];

  function checkAdult(age) {
    return age >= 18;
  }

 ages.filter(checkAdult)

 // [32, 33, 40]



var ages = [3, 10, 18, 20];

function checkAdult(age) {
  return age >= 18;
}

ages.find(checkAdult)

// 18 


var ages = [3, 10, 18, 20];

function checkAdult(age) {
  return age >= 18;
}

ages.findIndex(checkAdult);

// 2 


var myArr = Array.from("ABCDEFG");

// expected output: Array ["A", "B", "C", "D", "E", "F", "G"]

Array.from([1, 2, 3], x => x + x);

// expected output: Array [2, 4, 6]


var fruits = ["Banana", "Orange", "Apple", "Mango"];

fruits.includes("Mango");

// expected output: true


var fruits = ["Banana", "Orange", "Apple", "Mango"];

fruits.indexOf("Apple");

// expected output: 2

var fruits = ["Banana", "Orange", "Apple", "Mango"];

Array.isArray(fruits);

// expected output: true

var fruits = ["Banana", "Orange", "Apple", "Mango"];

fruits.join();

// expected output: "Banana,Orange,Apple,Mango"

var fruits = ["Banana", "Orange", "Apple", "Mango"];

var fk = fruits.keys();

for (x of fk) { console.log(x) }

// expected output: 1
// expected output: 2
// expected output: 3
// expected output: 4

var fruits = ["Banana", "Apple", "Apple", "Apple"];

var a = fruits.lastIndexOf("Apple");

// expected output: 3

var numbers = [65, 44, 12, 4];
var newarray = numbers.map(myFunction)

function myFunction(num) {
  return num * 10;
}

// expected output: [650, 440, 120, 40]
