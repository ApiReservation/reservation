
## API Reservation
- For installation to this API please create local database and use the following commands:
*php artisan migrade
*php artisan db:seed
+

- [Create user](https://localhost.com/api/register).
  		*[name, email, password] are required parametars.
- [if token expire please use login method](https://localhost.com/api/register).
		*[email, password] are required parametars.	
- [Check available events](https://localhost.com/api/events).
  		*[token] is required parametar.
- [Check available tables for requested event ](https://localhost.com/api/tables).
  		*[token, date(please use following format DD-MM-YYY), event] are required parametar.
- [Create reservation ](https://localhost.com/api/reservation).
  		*[token, date(please use following format DD-MM-YYY), event, table] are required parametar.  
- [cancel reservation ](https://localhost.com/api/cancel/reservation).
  		*[token, event ] are required parametar.    				
- [Logout user](https://localhost.com/api/logut).
  		*[token] is required parametar.  		
