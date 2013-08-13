package main

import(
	"net/http"
	"fmt"
)

func initFrontendHandler(){
	http.HandleFunc("/list", frontendList)
	http.HandleFunc("/view", frontendView)
}
// article list
func frontendList(w http.ResponseWriter, r *http.Request){
	fmt.Fprintf(w, "article list")
}
// article view
func frontendView(w http.ResponseWriter, r *http.Request){
	fmt.Fprintf(w, "article view")
}
