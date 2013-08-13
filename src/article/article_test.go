package article

import(
	"testing"
	"fmt"
)

func TestArticleStruct(t *testing.T){
	keywords := []string{"Hello", "World"}
	article := Article{Id:1, Keywords:keywords}
	fmt.Println(article)
}
