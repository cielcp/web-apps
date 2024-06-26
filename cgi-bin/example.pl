#!/usr/bin/env perl

# Print out the HTTP header
# What happens if we leave this out?
print "Content-Type: text/plain\n\n";

# Print out a string
print "Environment Example in Perl!\n";

# Loop over the environment variables
for my $var (sort keys %ENV) {
    printf "%s: %s\n", $var, $ENV{$var};
}


# Access the firstname GET parameter
my $first_name = $q->param('firstname');

# Print a hello!
print "Hello $first_name!\n";

