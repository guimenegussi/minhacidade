# minhacidade
webapp social com fim de identificar problemas e soluções nas cidades.

Da seguinte forma, primeiramente a escrita dos dados seria feita no Cassandra pois ele tem uma escrita mais rápida porém um modelo mais complexo de modelagem que o MongoDb.

Depois dessa escrita os dados seriam replicados para o MongoDb que possui a mesma modelagem que seu sistema porém de um jeito mais simples de se usar em um sistema usando MEAN. A leitura do MongoDB é melhor que do Cassandra, mas não usamos eles apenas por isso, mas sim por manter nossos dados em um modelo mais simples natural ao sistema.

Eu disse que não usamos a leitura rápida como fator decisivo, pois utilizaremos o Redis para essa função já que ele é um banco de cache que funciona na RAM, mas com possibilidade de persistência.