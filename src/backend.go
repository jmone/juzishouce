package main

import(
	"net/http"
	"html/template"
	"fmt"
	"article"
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
	fmt.Fprintf(w, "Test manager login")
}

// manager logout
func backendManagerLogout(w http.ResponseWriter, r *http.Request){
	fmt.Fprintf(w, "manager logout")
}

// article create
func backendArticleCreate(w http.ResponseWriter, r *http.Request){
	//fmt.Fprintf(w, "article create")
	fmt.Println("method:", r.Method)
	article := article.Article{Id:100, Title:"Yiishare"}
	t, err := template.ParseFiles("templates/default/article_create.html")
	//err = t.ExecuteTemplate(w, "T", template.HTML("<script>alert('Test')</script>"))
	err = t.ExecuteTemplate(w, "create", article)
	if err != nil{
		fmt.Println(err.Error())
	}
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
