import javax.servlet.*;
import javax.servlet.http.*;
import java.io.*;
import java.util.*;

public class FeedbackServlet extends HttpServlet {
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        HttpSession session = request.getSession();

        List<String> feedbackList = (List<String>) session.getAttribute("feedbackList");
        if (feedbackList == null) {
            feedbackList = new ArrayList<>();
            session.setAttribute("feedbackList", feedbackList);
        }

        String name = request.getParameter("name");
        String email = request.getParameter("email");
        String feedback = request.getParameter("feedback");

        String feedbackEntry = "<strong>Name:</strong> " + name +
                               "<br><strong>Email:</strong> " + email +
                               "<br><strong>Feedback:</strong> " + feedback + "<hr>";
        feedbackList.add(feedbackEntry);

        response.sendRedirect("feedback");
    }

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        HttpSession session = request.getSession();
        List<String> feedbackList = (List<String>) session.getAttribute("feedbackList");

        out.println("<!DOCTYPE html>");
        out.println("<html><head><title>Feedback Submissions</title></head><body>");
        out.println("<h1>Submitted Feedback</h1>");

        if (feedbackList != null && !feedbackList.isEmpty()) {
            for (String feedback : feedbackList) {
                out.println("<p>" + feedback + "</p>");
            }
        } else {
            out.println("<p>No feedback submitted yet!</p>");
        }

        out.println("<p><a href='index.html'>Go Back to Feedback Form</a></p>");
        out.println("</body></html>");
    }
}
