package main

import(
	"article"
	"fmt"
	"log"
	"flag"
	"net/http"
)

var(
	httpAddr     = flag.String("http", "localhost:8080", "HTTP listen address")
	contentPath  = flag.String("content", "content/", "path to content files")
	templatePath = flag.String("template", "template/", "path to template files")
	staticPath   = flag.String("static", "static/", "path to static files")
)

func main(){
	flag.Parse()
	keywords := []string{"Hello", "World"}
	article := article.Article{Id:1, Keywords:keywords}
	fmt.Println(article)

	fs := http.FileServer(http.Dir(*staticPath))
	http.Handle("/static/", http.StripPrefix("/static/", fs))

	initBackendHandler()
	initFrontendHandler()

	err := http.ListenAndServe(*httpAddr, nil)
	if err != nil{
		log.Fatal(err)
	}
}
