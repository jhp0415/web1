#-*- coding: utf-8 -*-

from bs4 import BeautifulSoup
import requests
#import MySQLdb
import pymysql
import time
import random
import re
import lxml
#from importlib import reload
#import sys
#reload(sys)
#sys.setdefaultencoding('utf-8')

#Open database connection
con = pymysql.connect(host='localhost', port=3306, user='newuser',password='jh_park0415',db='dbproject', charset='utf8', autocommit=True)
#con.set_character_set('utf8')
#Prepare a cursor object using cursor() method
cur = con.cursor()



#Insert
sql = "insert into food(fno, fname, faddress, fphone, fimageurl, fhomepage,fpark, fmileage, fintro, fexc) values (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"

'''
#final
cur.execute(sql, values)
con.commit()
'''

#----------------------------------------------------------------------------------------------

url='http://tour.jecheon.go.kr/ktour/selectClturCntntsList.do?scrit1.sc1=502000&scrit1.sc2=all&scrit1.so1=X.CLTUR_CNTNTS_NM&scrit1.ad1=ASC&scrit1.sa3=20&scrit1.sa3=40&scrit1.sa3=50&scrit1.sa3=60&scrit1.sa3=65&scrit1.sa3=70&scrit1.sa3=80&scrit1.rcpp=9&key=116&scrit1.cpn='

#사이트에 리스트들의 herf주소들 모두  가져오기
def findUrl(number):
    html=requests.get(url+str(number))      #기본주소에 페이지넘버를 결합, 다음페이지는 숫자++ =>소스를 받아온다.
    
    #print(html.text)
    soup=BeautifulSoup(html.text, 'lxml')   #html소스에서 텍스트를 가져와 BeautifulSoup을 통해 텍스트를 bs오브젝트로 만든다.
    titles_url=soup.find_all('div', class_='photo_area')    #div태그중 class가 photo_area인 것을 모두 가져온다. (리스트로 저장)
   
    return_url = []     #리스트 생성
    
    for url_ in titles_url:
        print(url_)
        urll=url_.find('a')     #Url찾기. Url에서 a태그 찾기
        turl='http://tour.jecheon.go.kr/ktour/{0}'.format(urll['href'])   #a태그안의 href태그내용 가져와 주소에 붙이기
        print(turl)     #링크 출력하기
        return_url.append(turl)     #append는 리스트의 마지막에 추가하는 함수

    return return_url

#-------------------------------------------------------------------------------------------------
'''
#가져온 herf주소로 이동하여 이미지url 가져오기
def getImageUrl(re_url):
    return_url = []
    for img_url in re_url:
        html = requests.get(img_url)
        soup=BeautifulSoup(html.text, 'lxml')
        tmp = soup.find('div', class_ = 'img_viewer_list visual_area')
        tag_img = tmp.find('img')
        iurl = 'http://tour.jecheon.go.kr{0}'.format(tag_img['src'])
        #print(iurl)
        return_url.append(iurl)

    print("이미지url완료")   
    return return_url

'''
#------------------------------------------------------------------------------------------------

#이름, 주소, 전화번호 등 가져오기
def getData(re_url):
    for data in re_url:
        html = requests.get(data)
        soup=BeautifulSoup(html.text, 'lxml')
        tmp = soup.find('span', class_ = 'big_photo')
        #print(tmp)
        if tmp == None:
           iurl = ' '
        else:
            tag_img = tmp.find('img')
            iurl = 'http://tour.jecheon.go.kr{0}'.format(tag_img['src'])
        print(iurl)
        
        html = requests.get(data)
        soup=BeautifulSoup(html.text, 'lxml')
        head = soup.find('h2', class_ = 'h0')
        name_ = head.get_text().strip()      #이름
        print(name_)
        
        tmp1 = soup.find('li', class_ = 'icon_address width_l')
        address_ = tmp1.get_text().strip()
        print(address_[5:])       #주소

        tmp2 = soup.find('li', class_ = 'icon_tel width_l')
        tele_ = tmp2.get_text().strip()
        print(tele_[5:])       #주소

        tmp3 = soup.find('li', class_ = 'icon_park width_s')
        park_ = tmp3.get_text().strip() #주차
        print(park_)

        tmp7 = soup.find('li', class_ = 'icon_homepage width_l')
        home_ = tmp7.get_text().strip() #홈페이지
        print(home_)
        
        
        tmp4 = soup.find('li', class_ = 'icon_mileage width_s')
        mileage_ = tmp4.get_text().strip() #마일리지
        print(mileage_)


        head2 = soup.find_all('div', class_ = 'indent')
        intro_ = head2[0].get_text().strip()
        print(intro_)#소개


        number=1
        #cur.execute("insert into food values (?, ?, ?, ?, ?, ?, ?, ?, ?)",(name_,address_[5:],tele_[5:],iurl, park_[7:], home_[7:], mileage_[7:], intro_, ' '))
        cur.execute(sql, (number, name_,address_[5:],tele_[5:],iurl,park_[7:],home_[7:],mileage_[7:],intro_,' '))
        number+=1
        con.commit()
        
        
#-----------------------------------------------------------------------------------------------

#------메인함수-----------

for num in range(1,36):
    #디도스 공격 방지 random시간 생성
    time.sleep(random.random())
    href_urls = findUrl(num)

    getData(href_urls)


con.close()
