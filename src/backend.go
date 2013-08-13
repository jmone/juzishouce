package main

import(
	"net/http"
	"fmt"
)

func initBackendHandler(){
	http.HandleFunc("/backend/manager/login", backendManagerLogin)
	http.HandleFunc("/backend/manager/logout", backendManagerLogout)
	http.HandleFunc("/backend/article/create", backendArticleCreate)
	http.HandleFunc("/backend/article/delete", backendArticleDelete)
	http.HandleFunc("/backend/article/update", backendArticleUpdate)
	http.HandleFunc("/backend/article/list", backendArticleList)
}

// manager login
func backendManagerLogin(w http.ResponseWriter, r *http.Request){
	fmt.Fprintf(w, "manager login")
}

// manager logout
func backendManagerLogout(w http.ResponseWriter, r *http.Request){
	fmt.Fprintf(w, "manager logout")
}

// article create
func backendArticleCreate(w http.ResponseWriter, r *http.Request){
	fmt.Fprintf(w, "article create")
}

// article delete
func backendArticleDelete(w http.ResponseWriter, r *http.Request){
	fmt.Fprintf(w, "article delete")
}

// article update
func backendArticleUpdate(w http.ResponseWriter, r *http.Request){
	fmt.Fprintf(w, "article update")
}

// article list
func backendArticleList(w http.ResponseWriter, r *http.Request){
	fmt.Fprintf(w, "article list")
}
