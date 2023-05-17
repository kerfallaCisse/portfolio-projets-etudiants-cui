import com.mashape.unirest.http.HttpResponse;
import com.mashape.unirest.http.Unirest;
import com.mashape.unirest.http.exceptions.UnirestException;
    
	
	@GET
    @Path("userdb/{id}")
    public Response insertUserInAccount(@PathParam("{id}") String id) {
        

        try {
            // On vérifie si l'utilisateur existe dans la base de données
            
            Optional<User> user = User.findByIdOptional(id);
            if (user.isEmpty()) {
                
                String url = "https://dev-xuzmuq3g0kbtxrc4.us.auth0.com/api/v2/users?q=" + user_mail + "&search_engine=v3";
                HttpResponse<com.mashape.unirest.http.JsonNode> response = Unirest
                        .get(url)
                        .header("authorization",
                                "Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IlFJcTlFZWhPVG5BMHRCckpSci1HaiJ9.eyJpc3MiOiJodHRwczovL2Rldi14dXptdXEzZzBrYnR4cmM0LnVzLmF1dGgwLmNvbS8iLCJzdWIiOiJ4YXRwUWM2WHozZ1BLQ2RmcGxxc09RTEJqYkpmRmxSdkBjbGllbnRzIiwiYXVkIjoiaHR0cHM6Ly9kZXYteHV6bXVxM2cwa2J0eHJjNC51cy5hdXRoMC5jb20vYXBpL3YyLyIsImlhdCI6MTY4MzYyODM1MiwiZXhwIjoxNjgzNzE0NzUyLCJhenAiOiJ4YXRwUWM2WHozZ1BLQ2RmcGxxc09RTEJqYkpmRmxSdiIsInNjb3BlIjoicmVhZDpjbGllbnRfZ3JhbnRzIGNyZWF0ZTpjbGllbnRfZ3JhbnRzIGRlbGV0ZTpjbGllbnRfZ3JhbnRzIHVwZGF0ZTpjbGllbnRfZ3JhbnRzIHJlYWQ6dXNlcnMgdXBkYXRlOnVzZXJzIGRlbGV0ZTp1c2VycyBjcmVhdGU6dXNlcnMgcmVhZDp1c2Vyc19hcHBfbWV0YWRhdGEgdXBkYXRlOnVzZXJzX2FwcF9tZXRhZGF0YSBkZWxldGU6dXNlcnNfYXBwX21ldGFkYXRhIGNyZWF0ZTp1c2Vyc19hcHBfbWV0YWRhdGEgcmVhZDp1c2VyX2N1c3RvbV9ibG9ja3MgY3JlYXRlOnVzZXJfY3VzdG9tX2Jsb2NrcyBkZWxldGU6dXNlcl9jdXN0b21fYmxvY2tzIGNyZWF0ZTp1c2VyX3RpY2tldHMgcmVhZDpjbGllbnRzIHVwZGF0ZTpjbGllbnRzIGRlbGV0ZTpjbGllbnRzIGNyZWF0ZTpjbGllbnRzIHJlYWQ6Y2xpZW50X2tleXMgdXBkYXRlOmNsaWVudF9rZXlzIGRlbGV0ZTpjbGllbnRfa2V5cyBjcmVhdGU6Y2xpZW50X2tleXMgcmVhZDpjb25uZWN0aW9ucyB1cGRhdGU6Y29ubmVjdGlvbnMgZGVsZXRlOmNvbm5lY3Rpb25zIGNyZWF0ZTpjb25uZWN0aW9ucyByZWFkOnJlc291cmNlX3NlcnZlcnMgdXBkYXRlOnJlc291cmNlX3NlcnZlcnMgZGVsZXRlOnJlc291cmNlX3NlcnZlcnMgY3JlYXRlOnJlc291cmNlX3NlcnZlcnMgcmVhZDpkZXZpY2VfY3JlZGVudGlhbHMgdXBkYXRlOmRldmljZV9jcmVkZW50aWFscyBkZWxldGU6ZGV2aWNlX2NyZWRlbnRpYWxzIGNyZWF0ZTpkZXZpY2VfY3JlZGVudGlhbHMgcmVhZDpydWxlcyB1cGRhdGU6cnVsZXMgZGVsZXRlOnJ1bGVzIGNyZWF0ZTpydWxlcyByZWFkOnJ1bGVzX2NvbmZpZ3MgdXBkYXRlOnJ1bGVzX2NvbmZpZ3MgZGVsZXRlOnJ1bGVzX2NvbmZpZ3MgcmVhZDpob29rcyB1cGRhdGU6aG9va3MgZGVsZXRlOmhvb2tzIGNyZWF0ZTpob29rcyByZWFkOmFjdGlvbnMgdXBkYXRlOmFjdGlvbnMgZGVsZXRlOmFjdGlvbnMgY3JlYXRlOmFjdGlvbnMgcmVhZDplbWFpbF9wcm92aWRlciB1cGRhdGU6ZW1haWxfcHJvdmlkZXIgZGVsZXRlOmVtYWlsX3Byb3ZpZGVyIGNyZWF0ZTplbWFpbF9wcm92aWRlciBibGFja2xpc3Q6dG9rZW5zIHJlYWQ6c3RhdHMgcmVhZDppbnNpZ2h0cyByZWFkOnRlbmFudF9zZXR0aW5ncyB1cGRhdGU6dGVuYW50X3NldHRpbmdzIHJlYWQ6bG9ncyByZWFkOmxvZ3NfdXNlcnMgcmVhZDpzaGllbGRzIGNyZWF0ZTpzaGllbGRzIHVwZGF0ZTpzaGllbGRzIGRlbGV0ZTpzaGllbGRzIHJlYWQ6YW5vbWFseV9ibG9ja3MgZGVsZXRlOmFub21hbHlfYmxvY2tzIHVwZGF0ZTp0cmlnZ2VycyByZWFkOnRyaWdnZXJzIHJlYWQ6Z3JhbnRzIGRlbGV0ZTpncmFudHMgcmVhZDpndWFyZGlhbl9mYWN0b3JzIHVwZGF0ZTpndWFyZGlhbl9mYWN0b3JzIHJlYWQ6Z3VhcmRpYW5fZW5yb2xsbWVudHMgZGVsZXRlOmd1YXJkaWFuX2Vucm9sbG1lbnRzIGNyZWF0ZTpndWFyZGlhbl9lbnJvbGxtZW50X3RpY2tldHMgcmVhZDp1c2VyX2lkcF90b2tlbnMgY3JlYXRlOnBhc3N3b3Jkc19jaGVja2luZ19qb2IgZGVsZXRlOnBhc3N3b3Jkc19jaGVja2luZ19qb2IgcmVhZDpjdXN0b21fZG9tYWlucyBkZWxldGU6Y3VzdG9tX2RvbWFpbnMgY3JlYXRlOmN1c3RvbV9kb21haW5zIHVwZGF0ZTpjdXN0b21fZG9tYWlucyByZWFkOmVtYWlsX3RlbXBsYXRlcyBjcmVhdGU6ZW1haWxfdGVtcGxhdGVzIHVwZGF0ZTplbWFpbF90ZW1wbGF0ZXMgcmVhZDptZmFfcG9saWNpZXMgdXBkYXRlOm1mYV9wb2xpY2llcyByZWFkOnJvbGVzIGNyZWF0ZTpyb2xlcyBkZWxldGU6cm9sZXMgdXBkYXRlOnJvbGVzIHJlYWQ6cHJvbXB0cyB1cGRhdGU6cHJvbXB0cyByZWFkOmJyYW5kaW5nIHVwZGF0ZTpicmFuZGluZyBkZWxldGU6YnJhbmRpbmcgcmVhZDpsb2dfc3RyZWFtcyBjcmVhdGU6bG9nX3N0cmVhbXMgZGVsZXRlOmxvZ19zdHJlYW1zIHVwZGF0ZTpsb2dfc3RyZWFtcyBjcmVhdGU6c2lnbmluZ19rZXlzIHJlYWQ6c2lnbmluZ19rZXlzIHVwZGF0ZTpzaWduaW5nX2tleXMgcmVhZDpsaW1pdHMgdXBkYXRlOmxpbWl0cyBjcmVhdGU6cm9sZV9tZW1iZXJzIHJlYWQ6cm9sZV9tZW1iZXJzIGRlbGV0ZTpyb2xlX21lbWJlcnMgcmVhZDplbnRpdGxlbWVudHMgcmVhZDphdHRhY2tfcHJvdGVjdGlvbiB1cGRhdGU6YXR0YWNrX3Byb3RlY3Rpb24gcmVhZDpvcmdhbml6YXRpb25zIHVwZGF0ZTpvcmdhbml6YXRpb25zIGNyZWF0ZTpvcmdhbml6YXRpb25zIGRlbGV0ZTpvcmdhbml6YXRpb25zIGNyZWF0ZTpvcmdhbml6YXRpb25fbWVtYmVycyByZWFkOm9yZ2FuaXphdGlvbl9tZW1iZXJzIGRlbGV0ZTpvcmdhbml6YXRpb25fbWVtYmVycyBjcmVhdGU6b3JnYW5pemF0aW9uX2Nvbm5lY3Rpb25zIHJlYWQ6b3JnYW5pemF0aW9uX2Nvbm5lY3Rpb25zIHVwZGF0ZTpvcmdhbml6YXRpb25fY29ubmVjdGlvbnMgZGVsZXRlOm9yZ2FuaXphdGlvbl9jb25uZWN0aW9ucyBjcmVhdGU6b3JnYW5pemF0aW9uX21lbWJlcl9yb2xlcyByZWFkOm9yZ2FuaXphdGlvbl9tZW1iZXJfcm9sZXMgZGVsZXRlOm9yZ2FuaXphdGlvbl9tZW1iZXJfcm9sZXMgY3JlYXRlOm9yZ2FuaXphdGlvbl9pbnZpdGF0aW9ucyByZWFkOm9yZ2FuaXphdGlvbl9pbnZpdGF0aW9ucyBkZWxldGU6b3JnYW5pemF0aW9uX2ludml0YXRpb25zIHJlYWQ6b3JnYW5pemF0aW9uc19zdW1tYXJ5IGNyZWF0ZTphY3Rpb25zX2xvZ19zZXNzaW9ucyBjcmVhdGU6YXV0aGVudGljYXRpb25fbWV0aG9kcyByZWFkOmF1dGhlbnRpY2F0aW9uX21ldGhvZHMgdXBkYXRlOmF1dGhlbnRpY2F0aW9uX21ldGhvZHMgZGVsZXRlOmF1dGhlbnRpY2F0aW9uX21ldGhvZHMiLCJndHkiOiJjbGllbnQtY3JlZGVudGlhbHMifQ.Go_Q7Ot9OBSDMDYTZVdI1pusqRmNXpw4WgJlftOKCc1L4jkMkJDdqxUC-6EidSF97xHzp685m-KXhE9hTWapWSC0-EJi7tir2RVwKhaPlJgOJg4OSE0Po4rK92lu_5ZqcrF-qGp9RVHWpOpZ4i99H4OqWCqx8WKlFYeC7ueZWrQZDOEzFUD3zfeU4GN6Tl5ho2kvh7UJDLDbgTfnLmmTY8ESMwoFc5f7oq6ov1qidh4CGhP8NL5JzTeANJxzEegYNlMohm7cjs72bW7eVrIoIq440-PNrTsLrEq_DX_x3yINAvtEEmUr6hXn9Av31fV1N_vMZcESJyflM96cAJYm6A")
                        .asJson();
                JSONArray jsonArray = response.getBody().getArray();
                JSONObject jsonObject = jsonArray.getJSONObject(0);
                String user_name = jsonObject.getString("name");
                String email = jsonObject.getString("email");
                String auth0_user_id = jsonObject.getString("user_id");
                LocalDate current_date = LocalDate.now();

                User userToPersit = new User(user_name, email, auth0_user_id, current_date);
                userToPersit.persist();
                if(userToPersit.isPersistent()) return Response.status(Response.Status.CREATED).build();
            }
        } catch (UnirestException e) {
            e.printStackTrace();
        }

        return Response.status(Response.Status.BAD_REQUEST).build();

    }
	
	
	
	
    @GET
    @Path("date")
    public void testDate() {
        //LocalDateTime now = LocalDateTime.now();
        //System.out.println("Current Date and Time = " + now);
        //LocalDateTime last_seven_day = now.minusDays(7);
        //System.out.println("Date of 7ème jour en arrière = " + last_seven_day);
        LocalDate now = LocalDate.now();
        System.out.println(">>>>>>>> STATS FOR this week >>>>>>>>"); // On utilise la même logique pour les 30 derniers jours.
        System.out.println("Current Date and Time = " + now);
        System.out.println("Current Date and Time = " + now.minusDays(7));
        LocalDate enDate = now.minusDays(7);
        List<LocalDate> listOfDates = enDate.datesUntil(now).collect(Collectors.toList());
        System.out.println(listOfDates.size());
        for(LocalDate ld: listOfDates) {
            System.out.println(ld);
        }

        System.out.println(">>>>>>>> STATS FOR Last Three months >>>>>>>>");
        LocalDate date3month =  now.minusMonths(3);
        List<LocalDate> listOfDates2 = date3month.datesUntil(now).collect(Collectors.toList());
        System.out.println(listOfDates2.size());
        for(LocalDate ld: listOfDates2) {
            System.out.println(ld);
        }

        System.out.println(">>>>>>>> STATS FOR Last Year >>>>>>>>");
        //System.out.println(now.);


    private static JsonArrayBuilder jsonArrayBuilder = Json.createArrayBuilder();


    public static JsonArray statsWeek() {

        List<LocalDate> dates = Statistic.getDatesLastWeek();
        JsonObjectBuilder jsonObjectBuilder = Json.createObjectBuilder();

        for (LocalDate date : dates) {
            String day = date.getDayOfWeek().toString();
            Long nbrUser = User.find("created_at", date).count();
            jsonObjectBuilder.add(day,nbrUser);
        }
        jsonArrayBuilder.add(jsonObjectBuilder.build());

        
        return jsonArrayBuilder.build();

    }




    }
	
	    <dependency>
      <groupId>org.glassfish</groupId>
      <artifactId>javax.json</artifactId>
      <version>1.0.2</version>
    </dependency>
	
	    <dependency>
      <groupId>jakarta.json</groupId>
      <artifactId>jakarta.json-api</artifactId>
      <version>2.1.1</version>
    </dependency>
	
	
	
	30
2023-04-09
2023-04-10
2023-04-11
2023-04-12
2023-04-13
2023-04-14
2023-04-15
2023-04-16
2023-04-17
2023-04-18
2023-04-19
2023-04-20
2023-04-21
2023-04-22
2023-04-23
2023-04-24
2023-04-25
2023-04-26
2023-04-27
2023-04-28
2023-04-29
2023-04-30
2023-05-01
2023-05-02
2023-05-03
2023-05-04
2023-05-05
2023-05-06
2023-05-07
2023-05-08

        jsonObjectBuilder.add("sem1", weeks.get("sem1"));
        jsonObjectBuilder.add("sem2", weeks.get("sem2"));
        jsonObjectBuilder.add("sem3", weeks.get("sem3"));
        jsonObjectBuilder.add("sem4", weeks.get("sem4"));
        jsonObjectBuilder.add("sem5", weeks.get("sem5"));
        jsonObjectBuilder.add("sem6", weeks.get("sem6"));
        jsonObjectBuilder.add("sem7", weeks.get("sem7"));
        jsonObjectBuilder.add("sem8", weeks.get("sem8"));
        jsonObjectBuilder.add("sem9", weeks.get("sem9"));
        jsonObjectBuilder.add("sem10", weeks.get("sem10"));
        jsonObjectBuilder.add("sem11", weeks.get("sem11"));
        jsonObjectBuilder.add("sem12", weeks.get("sem12"));
		
Statistique

package stats.model;

import java.time.LocalDate;

import io.quarkus.hibernate.orm.panache.PanacheEntity;
import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import stats.Statistic;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;
import java.util.Map;
import java.util.Set;
import java.util.stream.Collectors;

import jakarta.json.Json;
import jakarta.json.JsonObject;
import jakarta.json.JsonObjectBuilder;

@Entity
public class User extends PanacheEntity {

    @Column(length = 100)
    public String name;

    @Column(length = 100)
    public String email;

    @Column(length = 100)
    public String auth0_user_id;

    @Column
    public LocalDate created_at;

    public static JsonObject statsWeek() {
        JsonObjectBuilder jsonObjectBuilder = Json.createObjectBuilder();
        List<LocalDate> dates = Statistic.getDatesLastWeek();
        for (LocalDate date : dates) {
            String day = date.getDayOfWeek().toString();
            Long nbrUser = User.find("created_at", date).count();
            jsonObjectBuilder.add(day, nbrUser);
        }
        return jsonObjectBuilder.build();
    }

    public static JsonObject statsMonth() {
        HashMap<String, Long> weeks = new HashMap<>() {
            {
                put("week1", 0L);
                put("week2", 0L);
                put("week3", 0L);
                put("week4", 0L);

            }
        };

        List<LocalDate> dates = Statistic.getDatesLastMonth();

        for (int i = 0; i < dates.size(); i++) {

            LocalDate date = dates.get(i);
            long nbrUser = User.find("created_at", date).count();

            if (i < 7)
                updateNbrOfUsersWeek("week1", nbrUser, weeks);

            else if (i >= 7 && i < 14)
                updateNbrOfUsersWeek("week2", nbrUser, weeks);

            else if (i >= 14 && i < 21)
                updateNbrOfUsersWeek("week3", nbrUser, weeks);

            else
                updateNbrOfUsersWeek("week4", nbrUser, weeks);

        }

        return constructResponseObject(weeks);

    }

    public static JsonObject statsLastThreeMonth(List<LocalDate> dates) {
        HashMap<String, Long> weeks = new HashMap<>() {
            {
                put("week1", 0L);
                put("week2", 0L);
                put("week3", 0L);
                put("week4", 0L);
                put("week5", 0L);
                put("week6", 0L);
                put("week7", 0L);
                put("week8", 0L);
                put("week9", 0L);
                put("week10", 0L);
                put("week11", 0L);
                put("week12", 0L);

            }
        };

        for (int i = 0; i < dates.size(); i++) {

            LocalDate date = dates.get(i);
            long nbrUser = User.find("created_at", date).count();

            if (i < 7)
                updateNbrOfUsersWeek("week1", nbrUser, weeks);

            else if (i >= 7 && i < 14)
                updateNbrOfUsersWeek("week2", nbrUser, weeks);

            else if (i >= 14 && i < 21)
                updateNbrOfUsersWeek("week3", nbrUser, weeks);

            else if (i >= 21 && i < 28)
                updateNbrOfUsersWeek("week4", nbrUser, weeks);

            else if (i >= 28 && i < 35)
                updateNbrOfUsersWeek("week4", nbrUser, weeks);

            else if (i >= 35 && i < 42)
                updateNbrOfUsersWeek("week5", nbrUser, weeks);

            else if (i >= 42 && i < 49)
                updateNbrOfUsersWeek("week6", nbrUser, weeks);

            else if (i >= 49 && i < 56)
                updateNbrOfUsersWeek("week7", nbrUser, weeks);

            else if (i >= 56 && i < 63)
                updateNbrOfUsersWeek("week8", nbrUser, weeks);

            else if (i >= 63 && i < 70)
                updateNbrOfUsersWeek("week9", nbrUser, weeks);

            else if (i >= 70 && i < 77)
                updateNbrOfUsersWeek("week10", nbrUser, weeks);

            else if (i >= 77 && i < 84)
                updateNbrOfUsersWeek("week11", nbrUser, weeks);

            else
                updateNbrOfUsersWeek("week12", nbrUser, weeks);

        }

        return constructResponseObject(weeks);
    }

    public static JsonObject statsLastYear() {

        HashMap<String, Long> months = new HashMap<>() {
            {
                put("month1", 0L);
                put("month2", 0L);
                put("month3", 0L);
                put("month4", 0L);
                put("month5", 0L);
                put("month6", 0L);
                put("month7", 0L);
                put("month8", 0L);
                put("month9", 0L);
                put("month10", 0L);
                put("month11", 0L);
                put("month12", 0L);
            }
        };

        LocalDate now = LocalDate.now();
        LocalDate _threeMonThDate1 = now.minusMonths(3);
        LocalDate _threeMonThDate2 = _threeMonThDate1.minusMonths(3);
        LocalDate _threeMonThDate3 = _threeMonThDate2.minusMonths(3);
        LocalDate _threeMonThDate4 = _threeMonThDate3.minusMonths(3);

        // We generate the interval dates for each dates
        List<LocalDate> _threeMonThDate4_list = _threeMonThDate4.datesUntil(_threeMonThDate3)
                .collect(Collectors.toList());
        List<LocalDate> _threeMonThDate3_list = _threeMonThDate3.datesUntil(_threeMonThDate2)
                .collect(Collectors.toList());
        List<LocalDate> _threeMonThDate2_list = _threeMonThDate2.datesUntil(_threeMonThDate1)
                .collect(Collectors.toList());
        List<LocalDate> _threeMonThDate1_list = _threeMonThDate1.datesUntil(now)
                .collect(Collectors.toList());

        JsonObject jsonObject1 = statsLastThreeMonth(_threeMonThDate4_list);
        System.out.println(jsonObject1.getJsonNumber("week5").toString());
        JsonObject jsonObject2 = statsLastThreeMonth(_threeMonThDate3_list);
        JsonObject jsonObject3 = statsLastThreeMonth(_threeMonThDate2_list);
        JsonObject jsonObject4 = statsLastThreeMonth(_threeMonThDate1_list);

        for (int i = 0; i < 4; i++) {
            Long _monthValue = 0L;
            if (i == 0) {
                _monthValue += Long.parseLong(jsonObject1.getJsonNumber("week1").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week2").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week3").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week4").toString());
                months.put("month1", _monthValue);
                _monthValue = 0L;
                _monthValue += Long.parseLong(jsonObject1.getJsonNumber("week5").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week6").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week7").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week8").toString());
                months.put("month2", _monthValue);
                _monthValue = 0L;
                _monthValue += Long.parseLong(jsonObject1.getJsonNumber("week9").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week10").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week11").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week12").toString());
                months.put("month3", _monthValue);
            } else if (i == 1) {
                _monthValue += Long.parseLong(jsonObject2.getJsonNumber("week1").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week2").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week3").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week4").toString());
                months.put("month4", _monthValue);
                _monthValue = 0L;
                _monthValue += Long.parseLong(jsonObject2.getJsonNumber("week5").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week6").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week7").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week8").toString());
                months.put("month5", _monthValue);
                _monthValue = 0L;
                _monthValue += Long.parseLong(jsonObject2.getJsonNumber("week9").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week10").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week11").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week12").toString());
                months.put("month6", _monthValue);
            } else if (i == 2) {
                _monthValue += Long.parseLong(jsonObject3.getJsonNumber("week1").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week2").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week3").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week4").toString());
                months.put("month7", _monthValue);
                _monthValue = 0L;
                _monthValue += Long.parseLong(jsonObject3.getJsonNumber("week5").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week6").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week7").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week8").toString());
                months.put("month8", _monthValue);
                _monthValue = 0L;
                _monthValue += Long.parseLong(jsonObject3.getJsonNumber("week9").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week10").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week11").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week12").toString());
                months.put("month9", _monthValue);
            } else {
                _monthValue += Long.parseLong(jsonObject4.getJsonNumber("week1").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week2").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week3").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week4").toString());
                months.put("month10", _monthValue);
                _monthValue = 0L;
                _monthValue += Long.parseLong(jsonObject4.getJsonNumber("week5").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week6").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week7").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week8").toString());
                months.put("month11", _monthValue);
                _monthValue = 0L;
                _monthValue += Long.parseLong(jsonObject4.getJsonNumber("week9").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week10").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week11").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week12").toString());
                months.put("month12", _monthValue);
            }

        }

        // computeJsonMonth(jsonObject1, months, 1);
        // computeJsonMonth(jsonObject2, months, 4);
        // computeJsonMonth(jsonObject3, months, 7);
        // computeJsonMonth(jsonObject4, months, 10);

        return constructResponseObject(months);

    }

    private static void updateNbrOfUsersWeek(String key, Long nbrUser, HashMap<String, Long> weeks) {
        Long nbrOfUser = weeks.get(key);
        weeks.put(key, nbrOfUser + nbrUser);
    }

    // private static void computeJsonMonth(JsonObject jsonObject, HashMap<String,
    // Long> months, int start_month) {

    // int i = 4;
    // while(i < 49) {
    // var values = computeMonthValue(i, jsonObject, start_month);
    // var _monthValue = values.get(0);
    // var m = values.get(1);

    // String key = "month" + Long.toString(m);
    // months.put(key, _monthValue);
    // i += 4;
    // }

    // }

    private static void computeMonthValue(int week, JsonObject jsonObject,
            int m, HashMap<String, Long> months) {
        Long _monthValue = 0L;
        // List<Long> values = new ArrayList<>();
        if (week == 4) {
            _monthValue = Long.parseLong(jsonObject.getJsonNumber("week1").toString())
                    + Long.parseLong(jsonObject.getJsonNumber("week2").toString())
                    + Long.parseLong(jsonObject.getJsonNumber("week3").toString())
                    + Long.parseLong(jsonObject.getJsonNumber("week4").toString());

        } else if (week == 8) {
            _monthValue = Long.parseLong(jsonObject.getJsonNumber("week5").toString())
                    + Long.parseLong(jsonObject.getJsonNumber("week6").toString())
                    + Long.parseLong(jsonObject.getJsonNumber("week7").toString())
                    + Long.parseLong(jsonObject.getJsonNumber("week8").toString());
            m += 1;
        } else if (week == 12) {
            _monthValue = Long.parseLong(jsonObject.getJsonNumber("week9").toString())
                    + Long.parseLong(jsonObject.getJsonNumber("week10").toString())
                    + Long.parseLong(jsonObject.getJsonNumber("week11").toString())
                    + Long.parseLong(jsonObject.getJsonNumber("week12").toString());
            m += 2;
        }

        String month = "month" + Long.toString(Long.valueOf(m));
        months.put(month, _monthValue);

        // values.add(_monthValue);
        // values.add(Long.valueOf(m));
        // return values;

    }

    private static JsonObject constructResponseObject(HashMap<String, Long> map) {
        JsonObjectBuilder jsonObjectBuilder = Json.createObjectBuilder();
        Set<Map.Entry<String, Long>> paires = map.entrySet();
        Iterator<Map.Entry<String, Long>> iter = paires.iterator();

        while (iter.hasNext()) {
            Map.Entry<String, Long> paire = iter.next();
            jsonObjectBuilder.add(paire.getKey(), paire.getValue());
        }

        return jsonObjectBuilder.build();
    }

}
Ce qui marche

        for (int i = 0; i < 4; i++) {
            Long _monthValue = 0L;
            if (i == 0) {
                _monthValue += Long.parseLong(jsonObject1.getJsonNumber("week1").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week2").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week3").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week4").toString());
                months.put("month1", _monthValue);
                _monthValue = 0L;
                _monthValue += Long.parseLong(jsonObject1.getJsonNumber("week5").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week6").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week7").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week8").toString());
                months.put("month2", _monthValue);
                _monthValue = 0L;
                _monthValue += Long.parseLong(jsonObject1.getJsonNumber("week9").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week10").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week11").toString())
                        + Long.parseLong(jsonObject1.getJsonNumber("week12").toString());
                months.put("month3", _monthValue);
            } else if (i == 1) {
                _monthValue += Long.parseLong(jsonObject2.getJsonNumber("week1").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week2").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week3").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week4").toString());
                months.put("month4", _monthValue);
                _monthValue = 0L;
                _monthValue += Long.parseLong(jsonObject2.getJsonNumber("week5").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week6").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week7").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week8").toString());
                months.put("month5", _monthValue);
                _monthValue = 0L;
                _monthValue += Long.parseLong(jsonObject2.getJsonNumber("week9").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week10").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week11").toString())
                        + Long.parseLong(jsonObject2.getJsonNumber("week12").toString());
                months.put("month6", _monthValue);
            } else if (i == 2) {
                _monthValue += Long.parseLong(jsonObject3.getJsonNumber("week1").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week2").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week3").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week4").toString());
                months.put("month7", _monthValue);
                _monthValue = 0L;
                _monthValue += Long.parseLong(jsonObject3.getJsonNumber("week5").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week6").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week7").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week8").toString());
                months.put("month8", _monthValue);
                _monthValue = 0L;
                _monthValue += Long.parseLong(jsonObject3.getJsonNumber("week9").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week10").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week11").toString())
                        + Long.parseLong(jsonObject3.getJsonNumber("week12").toString());
                months.put("month9", _monthValue);
            } else {
                _monthValue += Long.parseLong(jsonObject4.getJsonNumber("week1").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week2").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week3").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week4").toString());
                months.put("month10", _monthValue);
                _monthValue = 0L;
                _monthValue += Long.parseLong(jsonObject4.getJsonNumber("week5").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week6").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week7").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week8").toString());
                months.put("month11", _monthValue);
                _monthValue = 0L;
                _monthValue += Long.parseLong(jsonObject4.getJsonNumber("week9").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week10").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week11").toString())
                        + Long.parseLong(jsonObject4.getJsonNumber("week12").toString());
                months.put("month12", _monthValue);
            }

        }