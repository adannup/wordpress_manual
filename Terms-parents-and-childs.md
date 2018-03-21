La funcion *get_terms()* obtiene *absolutamente todos los terms* de la taxonomia, se pueden poner ciertos filtros a traves de las opciones que recibe dicha funcion para evitar mostrar los elementos hijos de los elementos padre.

Se puede por ejemplo mostrar solamente los terms padres, pero ya sera tarea tuya de programar, quiza esto te de una pista:
Cuando un term es el elemento Top parent entonces una de sus propiedades estara definida como se muestr a continuacion `[parent] => 0`, cualquier elemento child tiene asignado el ID de su elemento padre.

Ahora bien tambien se puede obtener unicamente los elementos padre haciendo uso de la funcion *get_categories()* este elemento aun no lo investigo al 100% por lo que desconozco sus implicaciones, pero con ello obtendras unicamente los elementos top padre de cualquier taxonomia.
