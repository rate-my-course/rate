import urllib
from bs4 import BeautifulSoup

def main():
	course_address = "http://www.washington.edu/students/timeschd/SPR2016/"
	course_html = get_html(course_address)
	soup = BeautifulSoup(course_html, "html.parser")
	course_links = get_links(soup)
	courses = get_courses(course_address, course_links)
	write_courses(courses)

def write_courses(courses):
	text = ""
	for course in courses:
		text = text + course["name"] + "\t" + course["number"] + "\n"
	target = open("courses", 'w')
	target.write(text)
	target.close()

def get_courses(address, links):
	index = 0
	courses = []
	for link in links:
		index = index + 1
		html = get_html(address + link)
		soup = BeautifulSoup(html, "html.parser")
		count = -1
		for b in soup.find_all("b"):
			count = count + 1
			if count % 2 == 0:
				course = dict()
				splited_text = b.text.split()
				if len(splited_text) < 2:
					continue
				if not splited_text[1].isdigit():
					continue
				course["name"] = splited_text[0]
				course["number"] = splited_text[1]
				courses.append(course)
	return courses
		
def get_links(soup):
	course_links = []
	is_wanted_link = False
	for link in soup.find_all("a"):
		href = link.get("href")
		if href is not None:
			if href == "#AUP":
				is_wanted_link = True
			if is_wanted_link:
				if not href.startswith("#"):
					course_links.append(href)
			if href == "socwk.html":
				is_wanted_link = False
	return course_links

def get_html(url):
	handle = urllib.urlopen(url)
	html =  handle.read()
	return html

if __name__ == "__main__":
	main()