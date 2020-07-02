# distance-calculator

start server: php -S localhost:2323
run tests: vendor/bin/phpunit test/

Started building the calculator, in red green refactor cycles.
Decided to use a little framework (Slim) to quickly setup an app with routing and errorhandling middleware.

Created a single (controller) action instantiated with a distance calculator, which
is the interface to the Distance model. The calculator can be seen as an application service
or command handler. The arguments for the calculate function are wrapped in a class called
CalculateDistance which can be seen as a command.

I have setup the route with a Invocation Strategy which is something that converts
the Request to the Command, and allows the controller action to accept the command as 
argument instead of a generic request object.

Assumed the api to be a Json api.
Decided to go with a POST request, the reasoning behind that, was that
it is about POST-ing a calculation command. A calculation of two distances
seems to be more about a function than it is about posting a resource.
That is why I did choose to treath the command as the posted resource.

calculate distance request: 
POST /calculate/{measure} // where {measure} is either yard or meter
{
  "distances":[
    {
      "measure": "meter",
      "distance": 1.0
    },
    {
      "measure": "yard",
      "distance": 2.0
    },
  ]
}
