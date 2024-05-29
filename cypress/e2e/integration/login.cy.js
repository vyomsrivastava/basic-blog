const baseUrl = "http://localhost/basic-blog/";
describe('Login', () => {

    beforeEach(() => {
        // runs before each test in the block
        cy.visit(baseUrl+'login')
    })

    it('should allow login and redirect to /dashboard', () => {

        // cy.get('#email').should('be.focused');
        cy.get("#email").type("captainvyom@google.com");

        cy.get("#password").type("admin@1234");

        cy.get("button[type='submit']").contains("Sign in").click();

        cy.url().should('include', '/dashboard');
    });

    it('should not allow login with incorrect password/email', () => {

        // cy.get('#email').should('be.focused');
        cy.get("#email").type("captainvyom@google22222.com");

        cy.get("#password").type("admin@1234");

        cy.get("button[type='submit']").contains("Sign in").click();

        cy.url().should('include', '/login');
        cy.contains("The provided credentials do not match our records.");
    })

    
})