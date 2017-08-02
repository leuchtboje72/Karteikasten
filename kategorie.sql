USE learnbox;
SELECT kat.id, kat.titel FROM kategorien kat WHERE aufgehaengt_an != 0;