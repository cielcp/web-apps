#!/usr/bin/env perl

# Use the CGI module
use CGI;

# Create a new CGI object
my $q = CGI->new;

# Access the firstname GET parameter
my $first_name = $q->param('firstname');

# Print a hello!
print "Hello $first_name!\n";

my $last_name = $q->param('lastname');
my $food = $q->param('food');

printMessage($first_name, $last_name, $food);

sub printMessage {
    my ($first_name, $last_name, $food) = @_;
    my $msg = "Hello $first_name $last_name!  Did you have $food for lunch?";
    print $msg;
}