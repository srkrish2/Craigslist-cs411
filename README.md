The scraper is modified from https://github.com/GoTrained/Scrapy-Craigslist. I will also add proxies.

HTML/JS/CSS/PHP code will be put into the app/ folder 

How to use Scraper:

0. Requirements: "pip install scrapy scrapy_proxies"

1. edit lines 7 and 25 of Scrapy-Craigslist-Master/craigslist/spiders/all-pages-content.py to reflect the URL of the city you are working on 

2. enter the Scrapy-Craigslist-Master folder

3. run "scrapy crawl jobscontent -o cityname_withdesc.csv"
  
4. move file to data/ folder

5. verify csv content. Add "-checked" to the end of the file name once checked.

Below is a list of cities for starters. Cross the city off if you use this list. Add more cities if you can think of any

~~carbondale~~
~~chambana~~
~~chicago~~
~~corvallis~~
~~portland~~
~~seattle~~
~~SAn fransisco~~
~~los angelos~~
~~boise, idaho~~
~~indianapolis~~
~~miami~~
atlanta
boston
new york
philadelphia
pittsburgh
ann arbor
niagra
las vegas
denver
boulder
salt lake city
lexington, VA
washington DC
dallas
austin
oklahoma city
columbus, OH

