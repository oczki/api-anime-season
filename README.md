# Public holidays API

Tiny API for checking what's the current anime season, and how far we're currently into it.  
This can help you estimate what's the latest episode number of a show that recently started airing.

It's not precise, because shows start at various dates. It's just a rough estimate.


## Endpoints

### `/`

Data of the current anime season.  
`season`: "spring" | "summer" | "fall" | "winter".  
`ep.oneCour`: an integer from 1 to 13.  
The other cours are just `oneCour` plus 13, plus 26, and plus 39. Just for convenience.

```json
{
  "season": "summer",
  "ep": {
    "oneCour": 6,
    "twoCour": 19,
    "threeCour": 32,
    "fourCour": 45
  }
}
```


## Installation

I'm hosting my own instance of this at https://oczki.pl/api/anime-season/. Feel free to use it.

If you want to host it yourself, just use [PHP 8+](https://www.php.net/).  
An `.htaccess` file for [Apache](https://httpd.apache.org/) is included in this repo.


## License

MIT.
