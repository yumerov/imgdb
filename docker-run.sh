docker build -t imgdb:v1 .
# docker run -d -p 8000:8000 --name imgdb-app imgdb
docker run -p 8000:8000 -i -t imgdb:v1