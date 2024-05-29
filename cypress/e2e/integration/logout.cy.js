const baseUrl = "http://localhost/basic-blog/";
describe('Login', () => {

    beforeEach(() => {
        // runs before each test in the block
        cy.visit(baseUrl+'login')
    })

    it('should allow login and redirect to /dashboard and then logs out', () => {

        // cy.get('#email').should('be.focused');
        cy.get("#email").type("captainvyom@google.com");

        cy.get("#password").type("admin@1234");

        cy.get("button[type='submit']").contains("Sign in").click();

        cy.url().should('include', '/dashboard');

        cy.get("button[type='button']").contains("Logout").click();
    });
})