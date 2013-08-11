package main

import (
	"flag"
	"log"
	"fmt"
	"net/http"
	"html"
)

var (
	host = flag.String("host", "localhost:8080", "Default hostname")
)

func init() {
	flag.Parse()
}

func fooHandler(w http.ResponseWriter, r *http.Request){
	fmt.Fprintf(w, "Call fooHandler()")
}

func main() {
	//log.Fatal(*host)

	//http.Handle("/foo", http.HandlerFunc(fooHandler))
	//http.HandleFunc("/foo", fooHandler)
	foo := http.HandlerFunc(fooHandler)
	http.Handle("/foo", foo)

	http.HandleFunc("/bar", func(w http.ResponseWriter, r *http.Request) {
		fmt.Fprintf(w, "Hello, %q", html.EscapeString(r.URL.Path))
	})

	err := http.ListenAndServe(*host, nil)
	if err != nil{
		log.Fatal(err)
	}
	//log.Fatal(http.ListenAndServe(*host, nil))
}
