import javax.servlet.*;
import javax.servlet.http.*;
import java.io.*;

public class VisitCounterServlet extends HttpServlet {

    @Override
    public void init() throws ServletException {
        ServletContext context = getServletContext();
        Integer visitCount = (Integer) context.getAttribute("visitCount");
        if (visitCount == null) {
            visitCount = 0;
        }
        context.setAttribute("visitCount", visitCount);
    }

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        ServletContext context = getServletContext();
        Integer visitCount = (Integer) context.getAttribute("visitCount");

        visitCount++;
        context.setAttribute("visitCount", visitCount);

        response.setContentType("text/html");
        PrintWriter out = response.getWriter();
        out.println("<html><body>");
        out.println("<h1>Welcome to the Eco-Friendly Lifestyle Tracker</h1>");
        out.println("<p>This page has been visited " + visitCount + " times.</p>");
        out.println("</body></html>");
    }
}
