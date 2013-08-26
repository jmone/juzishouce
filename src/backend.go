package main

import (
	"article"
	"fmt"
	"html/template"
	"net/http"
)

func initBackendHandler() {
	http.HandleFunc("/backend/manager/login", backendManagerLogin)
	http.HandleFunc("/backend/manager/logout", backendManagerLogout)
	http.HandleFunc("/backend/article/create", backendArticleCreate)
	http.HandleFunc("/backend/article/delete", backendArticleDelete)
	http.HandleFunc("/backend/article/update", backendArticleUpdate)
	http.HandleFunc("/backend/article/list", backendArticleList)
}

// manager login
func backendManagerLogin(w http.ResponseWriter, r *http.Request) {
	fmt.Fprintf(w, "Test manager login")
}

// manager logout
func backendManagerLogout(w http.ResponseWriter, r *http.Request) {
	fmt.Fprintf(w, "manager logout")
}

// article create
func backendArticleCreate(w http.ResponseWriter, r *http.Request) {
	fmt.Println("method:", r.Method)
	if r.Method == "GET" {
		article := article.Article{Id: 100, Title: "Yiishare"}
		t, err := template.ParseFiles("templates/default/article_create.html")
		//err = t.ExecuteTemplate(w, "T", template.HTML("<script>alert('Test')</script>"))
		err = t.ExecuteTemplate(w, "create", article)
		if err != nil {
			fmt.Println(err.Error())
		}
	} else {
		r.ParseForm()
		fmt.Println("Title:", r.Form["title"][0])
		fmt.Println("Content:", r.Form.Get("content"))
		fmt.Println("Source url:", r.Form["source_url"])
		fmt.Println("Keywords:", r.Form["keywords"])
		fmt.Printf("%v", r.Form)
	}
}

// article delete
func backendArticleDelete(w http.ResponseWriter, r *http.Request) {
	fmt.Fprintf(w, "article delete")
}

// article update
func backendArticleUpdate(w http.ResponseWriter, r *http.Request) {
	fmt.Fprintf(w, "article update")
}

// article list
func backendArticleList(w http.ResponseWriter, r *http.Request) {
	fmt.Fprintf(w, "article list")
}
