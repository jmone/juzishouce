package article

type Article struct{
	Id uint64
	Title string
	Content string
	Dateline uint32
	ViewCount uint32
	SourceUrl string
	Keywords []string
}

func init(){
	//
}

func (a Article)Create(title string, content string, dateline uint32, viewCount uint32, sourceUrl string, keywords []string){

}

func (a Article)Delete(id uint64){

}

func (a Article)Update(id uint64, title string, content string, dateline uint32, viewCount uint32, sourceUrl string, keywords []string){

}

func (a Article)Get(id uint64){

}

func (a Article)Count() uint64{
	return 1000
}

func (a Article)List(page, size uint32){

}
