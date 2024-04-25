const http = require('http');
const fs = require('fs');

const server = http.createServer((req, res) => {
    console.log("hello world");
    res.setHeader('Content-Type', 'text/php')
    fs.readFile('./index.php', (err, data) => {
        if (err) {
            res.writeHead(404);
            res.write("File not found!");
            console.log(err);
        } else {
            res.writeHead(200, { 'Content-Type': 'text/php' });
            res.write(data);
        }
        res.end();
    });
});

server.listen(3000, 'localhost', () => {
    console.log("Server running on port 3000");
});