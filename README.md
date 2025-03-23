# cgrd_task

installation:
```docker-compose up --build -d```  
migration:
```docker exec -i cgrd_task-db-1 mysql -u user -ppass testdb < src/migrations/create_news.sql ```
url:
http://localhost:82
