# Projet "La Roti"
Site de commande en ligne pour un fast food type rotissoire.

## Installation

* Cloner le projet chez soi :
```
git clone -b <<NOM_BRANCHE>> https://github.com/Leouarz/laroti.git
```
* Importer la base de donnée (Sur le drive 3IL)
* Modifier les configurations :

*Ex. conf.xml :*
```
<databases>
	<database name="leveau">
		<host>127.0.0.1</host>
		<user>root</user>
		<pass></pass>
		<name>laroti</name>
	</database>
</databases>
```
*conf.php :*
```
// GET DB information
$db_credentials = $xmlConfData->xpath('/databases/database[@name="leveau"]')[0];
```
