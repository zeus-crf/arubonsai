import  sqlite3  from 'sqlite3';
import { open } from 'sqlite';

async function criarTabelaPedidos (mesa, quantidade, prato){
    const db = await open ({
        filename:'./aru.db',
        driver: sqlite3.Database,
    })


    db.run(
        'CREATE TABLE IF NOT EXISTS pedidos (id INTEGER PRIMARY KEY, mesa INTEGER, quantidade INTEGER, prato TEXT)');
}

criarTabelaPedidos();