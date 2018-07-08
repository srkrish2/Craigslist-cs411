import scrapy
from scrapy import Request

class JobsSpider(scrapy.Spider):
    name = "jobscontent"
    allowed_domains = ["craigslist.org"]
    start_urls = ["https://miami.craigslist.org/search/cta"]

    def parse(self, response):
        cars = response.xpath('//p[@class="result-info"]')
        
        for car in cars:
            relative_url = car.xpath('a/@href').extract_first()
            absolute_url = response.urljoin(relative_url)
            title = car.xpath('a/text()').extract_first()
            address = car.xpath('span[@class="result-meta"]/span[@class="result-hood"]/text()').extract_first("")[2:-1]
            price = car.xpath('span[@class="result-meta"]/span[@class="result-price"]/text()').extract_first("")[1:]

            #print(absolute_url, relative_url, title, address, price)
            #input()
            
            yield Request(absolute_url, callback=self.parse_page, meta={'URL': absolute_url, 'Title': title, 'Address':address, 'Price':price})
            
        relative_next_url = response.xpath('//a[@class="button next"]/@href').extract_first()
        absolute_next_url = "https://miami.craigslist.org" + relative_next_url
        yield Request(absolute_next_url, callback=self.parse)
            
    def parse_page(self, response):
        url = response.meta.get('URL')
        title = response.meta.get('Title')
        address = response.meta.get('Address')
        price = response.meta.get('Price')
        
        description = "".join(line for line in response.xpath('//*[@id="postingbody"]/text()').extract()).strip()

        title2 = response.xpath('//p[@class="attrgroup"][1]/span[1]/b/text()').extract_first()

        labels = response.xpath('//p[@class="attrgroup"][2]/span/text()').extract()
        data = response.xpath('//p[@class="attrgroup"][2]/span/b/text()').extract()
        # print("here: ", labels, '/n')
        # print(data)
        # print(len(data))

        vin = ''
        condition = ''
        cylinders = ''
        drive = ''
        fuel = ''
        odometer = ''
        color = ''
        size = ''
        title_status = ''
        transmission = ''
        type = ''

        for i in range(0,len(data)):
            if (labels[i] == 'VIN: '):
                vin = data[i]
            if (labels[i] == 'condition: '):
                condition = data[i]
            if (labels[i] == 'cylinders: '):
                cylinders = data[i]
            if (labels[i] == 'drive: '):
                drive = data[i]
            if (labels[i] == 'fuel: '):
                fuel = data[i]
            if (labels[i] == 'odometer: '):
                odometer = data[i]
            if (labels[i] == 'paint color: '):
                color = data[i]
            if (labels[i] == 'size: '):
                size = data[i]
            if (labels[i] == 'title status: '):
                title_status = data[i]
            if (labels[i] == 'transmission: '):
                transmission = data[i]
            if (labels[i] == 'type: '):
                type = data[i]
            
        #need to sort through data and add in null values where needed

        # vin = response.xpath('//p[@class="attrgroup"][2][/span[1]/b/text()').extract_first()
        # condition = response.xpath('//p[@class="attrgroup"][2][/span[1]/b/text()').extract_first()
        # cylinders  = response.xpath('//p[@class="attrgroup"][2]/span[2]/b/text()').extract_first()
        # drive = response.xpath('//p[@class="attrgroup"][2]/span[3]/b/text()').extract_first()
        # fuel = response.xpath('//p[@class="attrgroup"][2]/span[4]/b/text()').extract_first()
        # odometer = response.xpath('//p[@class="attrgroup"][2]/span[5]/b/text()').extract_first()
        # color = response.xpath('//p[@class="attrgroup"][2]/span[6]/b/text()').extract_first()
        # size = response.xpath('//p[@class="attrgroup"][2]/span[7]/b/text()').extract_first()
        # title_status = response.xpath('//p[@class="attrgroup"][8]/span[2]/b/text()').extract_first()
        # transmission = response.xpath('//p[@class="attrgroup"][9]/span[2]/b/text()').extract_first()
        # type = response.xpath('//p[@class="attrgroup"][2]/span[10]/b/text()').extract_first()

        # print(odometer)
        # input()
        
        yield{'URL': url, 'Title': title, 'Title2': title2, 'Address':address, 'Price':price,
              'Description':description,
              'VIN':vin, 'Condition':condition, 'Cylinders':cylinders, 'Drive':drive, 'Fuel':fuel, 'Odometer':odometer,
              'Color':color, 'Size':size, 'TitleStatus':title_status, 'Transmission':transmission, 'Type':type}