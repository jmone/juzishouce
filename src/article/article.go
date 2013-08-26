package article

import(
	"labix.org/v2/mgo"
	"labix.org/v2/mgo/bson"
)

type Article struct{
	Id uint64
	Title string
	Content string
	Dateline uint32
	ViewCount uint32
	SourceUrl string
	Keywords []string
}

var(
	c *mgo.Collection
)

func init(){
	//
	session, err := mgo.Dial("127.0.0.1:27017")
	if err != nil{
		println("mgo dial fail"+err.Error())
		panic(err)
	}
	//defer session.Close()
	println("init")
	session.SetMode(mgo.Monotonic, true)
	c = session.DB("yiishare").C("article")
}

func (a Article)Create(title string, content string, dateline uint32, viewCount uint32, sourceUrl string, keywords []string){
	err := c.Insert(&Article{
		Title:title,
		Content:content,
		SourceUrl:sourceUrl,
		Keywords:keywords,
	})
	if err != nil{
		println("create fail:"+err.Error())
		panic(err)
	}
}

func (a Article)Delete(id uint64){

}

func (a Article)Update(id uint64, title string, content string, dateline uint32, viewCount uint32, sourceUrl string, keywords []string){

}

func (a Article)Get(id uint64) Article{
	result := Article{}
	err := c.Find(bson.M{"Id":id}).One(&result)
	if err != nil{
		panic(err)
	}
	return result
}

func (a Article)Count() uint64{
	return 1000
}

func (a Article)List(page, size uint32){

}
